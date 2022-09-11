<?php

namespace App\RabbitMQ\Producer;

interface ProducerInterface
{
    public function publish($host, $exchange, $exchangeType, $queue, $payload, $routingKey);
}