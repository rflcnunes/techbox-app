<?php

namespace App\RabbitMQ\Producer;

use Exception;
// use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\RabbitMQ\Producer\ProducerInterface;

class Producer implements ProducerInterface
{
    // private $amqpConnection;

    // public function __construct(AMQPStreamConnection $amqpConnection)
    // {
    //     $this->amqpConnection = $amqpConnection;
    // }

    public function publish($host, $exchange, $exchangeType, $queue, $payload, $routingKey)
    {
        $connection = new AMQPStreamConnection($host, 5672, 'guest', 'guest');

        $channel = $connection->channel();
    
        $channel->exchange_declare($exchange, $exchangeType);
    
        $channel->queue_declare($queue);
    
        $channel->queue_bind($queue, $exchange, $routingKey);
    
        $message = new AMQPMessage($payload);
    
        $channel->basic_publish($message, $exchange, $routingKey);
    
        $channel->close();
        $connection->close();
    }
}