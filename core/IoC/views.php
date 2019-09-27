<?php
namespace CoreIoC;
use CoreMain\IoC;
use Corelanguage\language;
class views extends IoC{
    public static function resolveView($name=false){  
        static::$setings['errorName']=language::trnaslate('ControllerExistError',false,'{name}',url[0]);
        static::$setings['errorValue']='controlerError';
        if(url){
            return self::resolve(url[0]);
        }else{
            return self::resolve('home');
        }
    }
}



