<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RabbitMQ\Consumer\ConsumerInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a AMQP consumer that defers work to the Laravel queue worker';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');

        $channel = $connection->channel();
    
        $callback = function ($message) {
            echo $message->body;
        };
        
        $channel->basic_consume('create_post_queue', '', false, true, false, false, $callback);
        $channel->basic_consume('post_log_queue', '', false, true, false, false, $callback);
        // $channel->basic_consume('sendEmail', '', false, true, false, false, $callback);
    
        while ($channel->is_consuming()) {
            $channel->wait();
        }
    
        $channel->close();
        $connection->close();
    }
}
