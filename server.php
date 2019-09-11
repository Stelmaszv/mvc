<?php
include 'setings.php';
require 'vendor/autoload.php';
use Ratchet\Server\IoServer;
use App\webSocket;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\migrate;
use App\sedder;
$server=IoServer::factory(
    new HttpServer(
        new WsServer(
            new webSocket()
        )
    ),
    8080
);
new migrate();
new sedder(0);
$server->run();