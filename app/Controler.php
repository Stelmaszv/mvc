<?php
namespace App;
abstract  class controler{
    public function __construct($templete=false){
        if(!$templete){
            $templete='templete/empty.htm';
        }
        $this->templete=new CTemplate($templete);
    }
    abstract function addElments();
    function view(){
        $this->addElments();
        return $this->templete->CGet();
    }
}