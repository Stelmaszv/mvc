<?php
namespace Corehelpel;
class urls{
    static private $url;
    function addToIssetUrl($data){
        self::$url='?'.$_SERVER['QUERY_STRING'].'&&'.$data;
    }
    static function refresh(){
        header('Location: '.config['projectUrl']);
    }
    static function home(){
        header('Location: '.config['projectUrl'].config['home']);
    }
    static function setLocation($url){
        header('Location:'.config['projectUrl'].$url);
    }
}