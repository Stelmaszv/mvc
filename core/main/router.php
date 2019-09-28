<?php
namespace CoreMain;
use CoreErorr\erorrDetect;
class router{
    public static $setings=array();
    public static $registry = [];
    public static $urls = [];
    static function route($url,$controler){
        $url= explode('/',$url);
        static::$registry[$url[0]] = $controler;
        static::$urls[$url[0]] = $url;
    }
    public static function registered($name){
        return array_key_exists($name, static::$registry);
    }
    static function createview(){
        if(url){
            if(count(static::$urls[url[0]])==count(url)){
                return self::resolve(url[0]);
            }
        }else{
            return self::resolve('home');
        }
    }
    public static function resolve($name=false){
        $name = static::$registry[$name];
        return $name(new self);
    }
}