<?php
namespace App;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ComponentInterface;
use App\WebSocketControleronOpen;
use App\WebSocketControleronMessage;
use App\WebSocketControleronClose;
class webSocket implements MessageComponentInterface{
    protected $clients;
    public function __construct(){
        $this->clients = new\SplObjectStorage();
    }
    function onOpen(ConnectionInterface $conn){
        //debag::varDump($this->clients);
        $this->clients->attach($conn);
        $onOpen= new WebSocketControleronOpen();
        $onOpen->execute();
    }
    public function onError(ConnectionInterface $conn, \Exception $e){
        echo $e->getMessage();
        $conn->close();

    }
    public function onClose(ConnectionInterface $conn){
        $onOpen= new WebSocketControleronClose();
        $onOpen->execute();
    }
    public function onMessage(ConnectionInterface $from, $msg){
        $mes=json_decode($msg);
        $onOpen= new WebSocketControleronMessage();
        $onOpen->execute($this->clients,$from,$mes);

    }
}