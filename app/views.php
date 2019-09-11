<?php
namespace App;
class views{
    public static $registry = [];
    public static function register($name,$resolve){
        static::$registry[$name] = $resolve;
    }
    public static function registered($name){
        return array_key_exists($name, static::$registry);
    }
    public static function resolve(){
        if(isset($_GET['view']) && count($_GET)>0 && isset($_GET['title'])) {
            if (!static::registered($_GET['view'])) {
                throw new \Exception(sprintf('%s is not registerd', $_GET['view']));
            }
            $name = static::$registry[$_GET['view']];
            return $name(new self);
        }else{
            $name = static::$registry['home'];
            return $name(new self);
        }


    }


}


