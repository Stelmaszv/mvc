<?php
require 'vendor/autoload.php';
use Ratchet\Server\IoServer;
use App\webSocket;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
$server=IoServer::factory(
    new HttpServer(
        new WsServer(
            new webSocket()
        )
    ),
    8080
);
$server->run();