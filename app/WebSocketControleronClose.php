<?php
namespace App;
use App\webSocket;
class WebSocketControleronClose extends webSocket {
    function execute(){
        echo 'bye bye';
    }
}