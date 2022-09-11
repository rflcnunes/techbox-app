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
    $channel->queue_declare('sendEmail', false, true, false, false);

    $rabbitMsg = new AMQPMessage('Hello World!');
    $channel->basic_publish($rabbitMsg, '', 'sendEmail');

    $channel->close();
    $connection->close();
});


