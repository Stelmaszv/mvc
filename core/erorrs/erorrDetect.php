<?php
namespace CoreErorr;
use Corehelpel\urls;
class erorrDetect{
    static function thrownew($error,$errorName){
        self::debagcheck();
        $url='error/main/'.$error;
        self::setError($error,$errorName);
        urls::setLocation($url);
    }
    function setError($error,$errorName){
        $_SESSION[$error]=$errorName;
    }
    function debagcheck(){
        if(!config['debag']){
            urls::home();
            die();
        }
    }
}

