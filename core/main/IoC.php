<?php
namespace CoreMain;
use CoreErorr\erorrDetect;
class IoC{
    public static $setings=array();
    public static $registry = [];
    public static function register($name,$resolve,$gard=false){
        static::$registry[$name] = $resolve;
    }
    public static function registered($name){
        return array_key_exists($name, static::$registry);
    }
    public static function resolve($name=false){
        if (!static::registered($name)) {
            erorrDetect::thrownew(static::$setings['errorValue'],static::$setings['errorName']);
            die();
            //throw new \Exception(sprintf('%s is not registerd', $name));
        }
        $name = static::$registry[$name];
        return $name(new self);
    }
}