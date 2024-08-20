<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EmployeeService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    public function sendMessage($queue, $data)
    {
        $msg = new AMQPMessage(json_encode($data));
        $this->channel->basic_publish($msg, '', $queue);
    }



    public function createEmployee($data)
    {
    
        $this->sendMessage('employee', [
            'event' => 'employee/add',
            'payload' => $data,
        ]);
    }
    public function updateEmployee($data)
    {
        $this->sendMessage('employee', [
            'event' => 'employee/update',
            'payload' => $data,
        ]);
    }

    public function deleteEmployee($id)
    {
        $this->sendMessage('employee', [
            'event' => 'employee/delete',
            'payload' => ['id' => $id],
        ]);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

}