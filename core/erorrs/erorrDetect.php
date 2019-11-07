<?php
namespace CoreErorr;
use Corehelpel\urls;
class erorrDetect{
    public static function thrownew($error,$errorName){
        self::debagcheck();
        $url='/'.$error;
        echo $errorName;
        die();
    }
    public function debagcheck(){
        if(!config['debag']){
            urls::home();
            die();
        }
    }
}

