<?php
namespace CoreMain;
use Coreinterface\gardinterface;
abstract class gard implements gardinterface{
    use \singletonCreate;
    private function __construct($data){
        $this->check($data);
    }
}