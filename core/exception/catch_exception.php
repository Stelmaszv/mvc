<?php
namespace core\exception;
use core\helpel\clas\text_in_consol;
class catch_exception{
    public static function throw_New(string $name,bool $in_console){
        if($in_console){
            text_in_consol::consol_log($name);
        }else{
            echo $name;
        }
        die();
    }
}
