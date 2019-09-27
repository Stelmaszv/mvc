<?php
namespace CoreMain;
abstract class gard{
    use \singletonCreate;
    private function __construct($data){
        $this->check($data);
    }
    abstract function check($data=false);
}