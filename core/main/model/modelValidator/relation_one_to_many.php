<?php
namespace core\main\model\modelValidator;
use core\exception\catch_exception;
class relation_one_to_many{
    function __construct(object $object){
        $this->object=$object;
    }
    function valid($value){
        echo 'dqd';
        \vd($this->object);
    }
}