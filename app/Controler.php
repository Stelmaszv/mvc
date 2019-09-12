<?php
namespace App;
abstract  class controler{
    public function __construct($templete){
         $this->templete=new CTemplate($templete);
         if(isset($_POST) && count($_POST)>0 ) {
             $this->onPost();
         }
    }
    function onPost(){}
    abstract function addElments();
    function view(){
        $this->addElments();
        return $this->templete->CGet();
    }
}