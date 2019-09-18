<?php
namespace helpels;
use helpels\debag;

class urls{
    static private $url;
    function addToIssetUrl($data){
        self::$url='?'.$_SERVER['QUERY_STRING'].'&&'.$data;
    }
    static function redirect(){
        header('Location: index.php'.self::$url);
    }
    static function setLocation($url){
        header('Location: index.php'.$url);
    }
    static function refresh(){
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}