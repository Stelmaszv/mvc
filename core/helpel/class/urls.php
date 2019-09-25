<?php
namespace Corehelpel;
class urls{
    static private $url;
    function addToIssetUrl($data){
        self::$url='?'.$_SERVER['QUERY_STRING'].'&&'.$data;
    }
    static function redirect(){
        header('Location: index.php'.self::$url);
    }
    static function setLocation($url){
        header('Location:http://localhost/mvc'.$url);
        die();
    }
    static function refresh(){
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    static function home(){
        header('Location: http://localhost/mvc/home');
    }
}