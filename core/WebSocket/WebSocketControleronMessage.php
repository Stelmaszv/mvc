<?php
namespace CoreWebSocket;
use CoreWebSocket\webSocket;
use Corehelpel\json;
use AppWs\SedMess;
class WebSocketControleronMessage extends webSocket{
    public function execute($clients,$form,$mes){
        $a=[];
        $a['messages']=new SedMess();
        $mes=json::json_decode($mes);
        $a[$mes->type]->execute($clients,$mes,$form);
    }
}