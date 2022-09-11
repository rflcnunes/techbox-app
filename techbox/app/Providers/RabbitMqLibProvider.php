<?php

namespace App\Providers;

use App\Console\Commands\ProducerCommand;
use Illuminate\Support\ServiceProvider;

use App\RabbitMQ\Producer\Producer;
use App\RabbitMQ\Producer\ProducerInterface;
use App\RabbitMQ\Consumer\Consumer;
use App\RabbitMQ\Consumer\ConsumerInterface;


class RabbitMqLibProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConsumerInterface::class, Consumer::class);

        $this->app->bind(  ProducerInterface::class, Producer::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
