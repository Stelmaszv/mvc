<?php
namespace model;
use App\model;
class users extends model{
    function SetMethods(){
        self::$table='users';
    }
}