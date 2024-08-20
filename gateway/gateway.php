<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('employee', false, false, false, false);
$channel->queue_declare('manager', false, false, false, false);

function sendMessage($queue, $event, $payload) {
    global $channel;

    $messageBody = json_encode(['event' => $event, 'payload' => $payload]);
    $msg = new AMQPMessage($messageBody);
    $channel->basic_publish($msg, '', $queue);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $queue = $_POST['queue'];
    $event = $_POST['event']; 
    $payload = $_POST['payload']; 

    sendMessage($queue, $event, $payload);

    echo 'Request sent to the queue';
}

$channel->close();
$connection->close();
?>