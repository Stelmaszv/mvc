<?php
namespace Corehelpel;
class json{
    static function json_encode(array $array){
        return json_encode($array);
    }
    static function json_decode(array $array){
        return json_decode($array);
    }
}