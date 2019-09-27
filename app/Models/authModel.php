<?php
namespace AppModel;
use CoreMain\model;
class authModel extends model{
    function  Setings(){
        self::$table='users';
        self::$unique='login';
    }
}   