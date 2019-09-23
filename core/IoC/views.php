<?php
namespace CoreIoC;
use CoreMain\IoC;
class views extends IoC{
    public static function resolveView($name=false){  
            static::$setings['errorName']='Controler <i>'.url[0].'</i> does not exist';
            static::$setings['errorValue']='controlerError'; 
        if(url){
            return self::resolve(url[0]);
        }else{
            return self::resolve('home');
        }
    }
}



