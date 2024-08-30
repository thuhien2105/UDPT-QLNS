<?php

namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;

class RabbitMQConnection
{
    private $connection;
    private $channel;
    private $employeeQueue;
    private $requestQueue;
    private $authQueue;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );
        $this->channel = $this->connection->channel();

        $this->employeeQueue = 'topic-employees';
        $this->requestQueue = 'topic-requests';
        $this->authQueue = 'topic-auths';
        $this->activityQueue = 'topic-activities';

        $this->channel->exchange_declare('exchange', 'direct', false, true, false);

        $this->channel->queue_declare($this->employeeQueue, false, true, false, false);
        $this->channel->queue_declare($this->requestQueue, false, true, false, false);
        $this->channel->queue_declare($this->authQueue, false, true, false, false);
        $this->channel->queue_declare($this->activityQueue, false, true, false, false);

        $this->channel->queue_bind($this->employeeQueue, 'exchange', 'employee_queue');
        $this->channel->queue_bind($this->requestQueue, 'exchange', 'request_queue');
        $this->channel->queue_bind($this->authQueue, 'exchange', 'auth_queue');
        $this->channel->queue_bind($this->activityQueue, 'exchange', 'activity_queue');
    }
    public function sendToEmployeeQueue($messageBody)
    {
        return $this->send($messageBody, 'exchange', 'employee_queue');
    }
    public function sendToAuthQueue($messageBody)
    {
        return $this->send($messageBody, 'exchange', 'auth_queue');
    }

    public function sendToRequestQueue($messageBody)
    {
        return $this->send($messageBody, 'exchange', 'request_queue');
    }

    public function sendToActivityQueue($messageBody)
    {
        return $this->send($messageBody, 'exchange', 'activity_queue');
    }


    private function send($messageBody, $exchange, $routingKey)
    {
        $correlationId = uniqid();
        list($callbackQueue,,) = $this->channel->queue_declare("", false, true, true, false);

        $message = new AMQPMessage(
            $messageBody,
            [
                'correlation_id' => $correlationId,
                'reply_to' => $callbackQueue
            ]
        );

        try {
            Log::info('Publishing message to exchange', [
                'exchange' => $exchange,
                'routing_key' => $routingKey,
                'message_body' => $messageBody
            ]);
            $this->channel->basic_publish($message, $exchange, $routingKey);
        } catch (\Exception $e) {
            Log::error('Error publishing message', ['exception' => $e->getMessage()]);
            throw $e;
        }

        $response = null;
        $callback = function ($msg) use ($correlationId, &$response) {
            Log::info('Received message', [
                'correlation_id' => $msg->get('correlation_id'),
                'body' => $msg->body
            ]);
            if ($msg->get('correlation_id') === $correlationId) {
                $response = json_decode($msg->body, true);
            }
        };

        $this->channel->basic_consume($callbackQueue, '', false, true, false, false, $callback);

        $startTime = time();
        while (!$response && (time() - $startTime) < 60) {
            try {
                $this->channel->wait(null, false, 10);
            } catch (\Exception $e) {
                Log::error('Error while waiting for response', ['exception' => $e->getMessage()]);
                break;
            }
        }

        $this->channel->basic_cancel($callbackQueue);

        if (!$response) {
            Log::warning('No response received within timeout period');
        }

        return $response;
    }

    public function __destruct()
    {
        if ($this->channel) {
            $this->channel->close();
        }
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
