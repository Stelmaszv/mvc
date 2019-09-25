<?php
namespace CoreMain;
use CoreMain\CTemplate;
use CoreErorr\erorrDetect;
use Corelanguage\language;
abstract class controller{
    use \singletonCreate;
    public $Settings=array();
    abstract function main();
    private function __construct(){   
        $this->Settings['templete']=config['templete']; 
        $this->settings();
        $this->setTemplete();
        $this->onConstract();
    }
    function onConstract(){}
    function settings(){}
    private function setTemplete(){
        if($this->Settings['templete']){
            $getTemplete=(new \ReflectionClass($this))->getShortName();
            $className = 'app/controlers/' .$getTemplete. '.htm';
            if(file_exists($className)){
                $this->templete = new CTemplate($className);
            }else{
                $TemplateEror=language::trnaslate('TemplateEror',false,'{className}',$className);
                erorrDetect::thrownew('TemplateEror',$TemplateEror);
            }
        }
    }
    function render(){
        if($this->Settings['templete']){
            return $this->templete->CGet();
        }
        
    }

}

