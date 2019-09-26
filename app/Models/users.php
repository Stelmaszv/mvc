<?php
namespace AppModel;
use CoreMain\model;
class users extends model{
    function  Setings(){
        self::$table='users';
        self::$unique='login';
    }
}   

