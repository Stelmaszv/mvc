<?php
require 'vendor/autoload.php';
require 'setings.php';
require 'migrate.php';
require 'seader.php';
use Ratchet\Server\IoServer;
use App\webSocket;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\migrate;
use App\seaderControler;
$server=IoServer::factory(
    new HttpServer(
        new WsServer(
            new webSocket()
        )
    ),
    8080
);
$server->run();