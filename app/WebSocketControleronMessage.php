<?php
namespace App;
use App\webSocket;
use helpels\debag;
use helpels\json;
use Wsaction\SedMess;
class WebSocketControleronMessage extends webSocket{
    function execute($clients,$form,$mes){
        $a=[];
        $a['messages']=new SedMess();
        $mes=json::json_decode($mes);
        $a[$mes->type]->execute($clients,$mes,$form);
    }
}