<?php
namespace CoreMain;
use CoreMain\CTemplate;
use CoreErorr\erorrDetect;
abstract class controller{
    use \singletonCreate;
    public $templeteSettings=array();
    abstract function main();
    private function __construct($templete=false){    
        $this->Settings=$templete;
        $this->settings();
        $this->setTemplete();
    }
    private function setTemplete(){
        if(!$this->Settings['notemplete']){
            $getTemplete=(new \ReflectionClass($this))->getShortName();
            $className = 'app/controlers/' .$getTemplete. '.htm';
            if(file_exists($className)){
                $this->templete = new CTemplate($className);
            }else{
                erorrDetect::thrownew('TemplateEror','Template file  <i>'.$className.'</i> does not exist');
            }
        }
    }
    function settings(){}
    function render(){
        $this->main();
        if(!isset($this->Settings['notemplete'])){
            return $this->templete->CGet();
        }
    }

}

