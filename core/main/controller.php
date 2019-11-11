<?php
namespace CoreMain;
use CoreMain\CTemplate;
use CoreErorr\erorrDetect;
use Corelanguage\language;
use Coreinterface\controlerinterface;
abstract class controller implements controlerinterface{
    use \singletonCreate,\className;
    public $Settings=array();
    private function __construct($gard){
        if($gard){
            $gard->check();
        }  
        $this->Settings=config['defultController'];
        $this->setmethod();
        $this->setTemplete();
        if(isset($_POST) && count($_POST)>0){
            $this->onPost();
        }
        $this->onConstract();
    }
    function onConstract(){}
    private function setmethod(){
        $this->settings();
    }
    function settings(){}
    private function setTemplete(){
        if($this->Settings['templete']){
            if($this->Settings['templeteshema']){
                $className = $this->Settings['templeteshema'];
            }else{
                $getTemplete=$this->classname();
                $className = 'app/controlers/' .$getTemplete. '.htm';
            }
            $getTemplete=$this->classname();
                if(file_exists($className)){
                    $this->templete = new CTemplate($className);
                }else{
                    $TemplateEror=language::trnaslate('TemplateEror',false,'{className}',$className);
                    erorrDetect::thrownew('TemplateEror',$TemplateEror);
                }
            
        }
    }
    function onPost(){}
    function render(){
        if($this->Settings['templete']){
            return $this->templete->CGet();
        }
        
    }
}

