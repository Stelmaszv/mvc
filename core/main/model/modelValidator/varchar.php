<?php
namespace core\main\model\modelValidator;
use core\exception\catch_exception;
class varchar{
    use \ class_Name;
    function valid($value){
        if(is_string($value)){
            return $value;
        }
        catch_exception::throw_New('value must be string',false);
    }
}