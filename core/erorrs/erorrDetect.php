<?php
namespace CoreErorr;
use Corehelpel\urls;
class erorrDetect{
    static function thrownew($error,$errorName){
        $url='/error/main/'.$error;
        self::setError($error,$errorName);
        urls::setLocation($url);
    }
    function setError($error,$errorName){
        $_SESSION[$error]=$errorName;
    }
}

