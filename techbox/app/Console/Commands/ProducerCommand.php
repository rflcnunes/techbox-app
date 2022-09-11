<?php

namespace App\Console\Commands;

// use App\RabbitMQ\Producer\Producer;
// use App\RabbitMQ\Producer\ProducerInterface;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ProducerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:producer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    
        $channel->exchange_declare('posts_events', 'direct');
    
        $channel->queue_declare('create_post_queue');
        $channel->queue_declare('post_log_queue');
    
        $channel->queue_bind('create_post_queue', 'posts_events', 'create_post');
        $channel->queue_bind('post_log_queue', 'posts_events', 'post_log');
    
        $firstMessage = new AMQPMessage('Create Post');
        $secondMessage = new AMQPMessage('Post Log');
    
        $channel->basic_publish($firstMessage, 'posts_events', 'create_post');
        $channel->basic_publish($secondMessage, 'posts_events', 'post_log');
    
        $channel->close();
        $connection->close();
    }
}
