<?php

use Illuminate\Support\Facades\Route;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send', function () {

    $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');

    $channel = $connection->channel();
    // $channel->queue_declare('sendEmail', false, true, false, false);

    // $rabbitMsg = new AMQPMessage('Hello World!');
    // $channel->basic_publish($rabbitMsg, '', 'sendEmail');

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
});

Route::get('/consumer', function () {

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
});


