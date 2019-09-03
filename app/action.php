<?php
namespace App;
abstract class action{
    abstract protected function execute($array);
    static function issetAction($value=false){
        if(!$value){
            $value='submit';
        }
        if(isset($_POST[$value])){
            return true;
        }
    }
}