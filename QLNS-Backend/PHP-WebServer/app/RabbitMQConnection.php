<?php

namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;

class RabbitMQConnection
{private $connection;
    private $channel;
    private $queueName;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );
        $this->channel = $this->connection->channel();

        $this->queueName = 'topic-employees';
        $this->channel->queue_declare($this->queueName, false, true, false, false);
        $this->channel->exchange_declare('employee_exchange', 'fanout', false, true, false);
    }

    public function sendMessageToQueue($messageBody)
    {
        $message = new AMQPMessage($messageBody);
        try {
            $this->channel->basic_publish($message, 'employee_exchange', $this->queueName);
            Log::info('Message published to queue', ['message_body' => $messageBody]);
        } catch (\Exception $e) {
            Log::error('Error publishing message', ['exception' => $e->getMessage()]);
            throw $e;
        }
    }

    public function send($messageBody)
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
    
            $this->channel->basic_publish($message, 'exchange');
        } catch (\Exception $e) {
            Log::error('Error publishing message', ['exception' => $e->getMessage()]);
            throw $e;
        }

        $response = null;
        $callback = function ($msg) use ($correlationId, &$response) {
    
            if ($msg->get('correlation_id') === $correlationId) {
                $response = json_decode($msg->body, true);
            }
        };

        $this->channel->basic_consume($callbackQueue, '', false, true, false, false, $callback);

            try {
                $this->channel->wait(null, false, 60); 
            } catch (\Exception $e) {
                Log::error('Error while waiting for response', ['exception' => $e->getMessage()]);
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