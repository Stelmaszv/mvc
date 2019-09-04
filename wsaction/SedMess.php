<?php
namespace Wsaction;
use App\wsAction;
class SedMess extends wsAction{
    function execute($clients,$msg,$from){
        foreach ($clients as $client) {
            if ($client !== $from) {
                $client->send($msg->mess);
            }
        }
    }
}