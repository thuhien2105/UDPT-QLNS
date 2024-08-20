<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private $connection;
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

    public function index()
    {
        $message = json_encode(['action' => 'get_all']);
        $response = $this->sendMessageAndGetResponse($message);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $employee = Employee::create($validatedData);
        $message = json_encode(['action' => 'create', 'employee' => $employee]);
        $this->sendMessageToQueue($message);
        return response()->json($employee, 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $employee->update($validatedData);
        $message = json_encode(['action' => 'update', 'id' => $id, 'employee' => $employee]);
        $this->sendMessageToQueue($message);
        return response()->json($employee);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();
        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $this->sendMessageToQueue($message);
        return response()->json(['message' => 'Employee deleted successfully']);
    }

    private function sendMessageAndGetResponse($messageBody)
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
            'exchange' => 'employee_exchange',
            'message_body' => $messageBody
        ]);
        $this->channel->basic_publish($message, 'employee_exchange');
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


    private function sendMessageToQueue($messageBody)
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