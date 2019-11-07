<?php
namespace CoreWebSocket;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ComponentInterface;
use CoreWebSocket\WebSocketControleronOpen;
use CoreWebSocket\WebSocketControleronMessage;
use CoreWebSocket\WebSocketControleronClose;
class webSocket implements MessageComponentInterface{
    protected $clients;
    public function __construct(){
        $this->clients = new\SplObjectStorage();
    }
    protected function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        $onOpen= new WebSocketControleronOpen();
        $onOpen->execute();
    }
    protected function onError(ConnectionInterface $conn, \Exception $e){
        echo $e->getMessage();
        $conn->close();
    }
    protected function onClose(ConnectionInterface $conn){
        $onOpen= new WebSocketControleronClose();
        $onOpen->execute();
    }
    protected function onMessage(ConnectionInterface $from, $msg){
        $onOpen= new WebSocketControleronMessage();
        $onOpen->execute($this->clients,$from,$msg);
    }
}