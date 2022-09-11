<?php

namespace App\RabbitMQ\Consumer;

use Closure;
use Exception;
// use Bschmitt\Amqp\Amqp;
// use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
// use PhpAmqpLib\Message\AMQPMessage;

class Consumer implements ConsumerInterface
{
    // private $amqp;

    // public function __construct(Amqp $amqp)
    // {
    //     $this->amqp = $amqp;
    // }

    public function consume($host, $queue, Closure $callback)
    {
        $connection = new AMQPStreamConnection($host, 5672, 'guest', 'guest');

        $channel = $connection->channel();

        $callback = function ($message) {
            echo PHP_EOL . 'Consuming: ' . $message->body . PHP_EOL . PHP_EOL . PHP_EOL . 'Press CTRL+C to exit' . PHP_EOL;
        };

        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
