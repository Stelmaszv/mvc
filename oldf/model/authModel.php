<?php
namespace model;
use App\debag;
use App\model;
class authModel extends model{
    function SetMethods(){
        self::$table=auth['table'];
        self::$unique=auth['loginField'];
    }
}