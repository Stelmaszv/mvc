<?php
namespace CoreMain;
use CoreErorr\erorrDetect;
use Corelanguage\language;
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
            if(isset(static::$urls[url[0]])){
                if(count(static::$urls[url[0]])==count(url)){
                    return self::resolve(url[0]);
                }
            }else{
                $ControllerExistError=language::trnaslate('TemplateEror',false,'{name}',url[0]);
                erorrDetect::thrownew($ControllerExistError,'ControllerExistError');
                die();
            }
        }else{
            return self::resolve('home'); 
        }
    }
    public static function resolve($name=false){
        if (!static::registered($name)) {
         
        }
        $name = static::$registry[$name];
        return $name(new self);
    }
}