<?php
namespace App;
use App\webSocket;
use Wsaction\SedMess;
class WebSocketControleronMessage extends webSocket{
    function execute($clients,$form,$mes){
        $a=[];
        $a['messages']=new SedMess();
        $a[$mes->type]->execute($clients,$mes,$form);
    }
}