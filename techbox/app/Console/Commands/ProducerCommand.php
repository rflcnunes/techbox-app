<?php

namespace App\Console\Commands;

use App\RabbitMQ\Producer\Producer;
use Illuminate\Console\Command;

class ProducerCommand extends Command
{
    private $producer;
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
    protected $description = 'Runs a AMQP producer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Producer $producer)
    {
        parent::__construct();
        $this->producer = $producer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->producer->publish('rabbitmq', 'posts_events', 'direct', 'create_post_queue', 'Create Post', 'create_post');
    }
}
