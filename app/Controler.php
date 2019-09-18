<?php
namespace App;
use controler\home;
abstract  class controler{
    use \singletonCreate;
    protected  function __construct($templete=false){
        if(!$templete) {
            $className = 'controler/' . $this->getTemplete() . '.htm';
        }else{
            $className=$templete;
        }

        $this->templete=new CTemplate($className);
        $this->onConstruct();
        if(isset($_POST) && count($_POST)>0 ) {
            $this->onPost();
        }
    }
    private function getTemplete(){
        return (new \ReflectionClass($this))->getShortName();
    }
     private function issetValue($array,$value,$true,$false){
         if(isset($array[$value])){
             return $true;
         }else{
             return $false;
         }
    }
    function onIssetGet($value){
        return $this->issetValue($_GET,$value,true,false);
    }
    function onConstruct(){}
    function onPost(){}
    abstract function addElments();
    function view(){
        $this->addElments();
        return $this->templete->CGet();
    }
}