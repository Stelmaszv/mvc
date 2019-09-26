<?php
namespace CoreMain;
use CoreMain\CTemplate;
use CoreErorr\erorrDetect;
use Corelanguage\language;
abstract class controller{
    use \singletonCreate,\className;
    public $Settings=array();
    abstract function main();
    private function __construct(){
        //$this->Settings['templete']=config['templete'];   
        $this->onConstract();
        $this->Settings=config['defultController'];
        $this->setmethod();
        $this->setTemplete();
        
    }
    function onConstract(){}
    function setmethod(){
        $this->settings();
        $this->check();
    }
    function settings(){
    
    }
    private function check(){
        if($this->Settings['requiredUrl']){
            if(count(url)!=$this->Settings['requiredUrl']){
                $urlLanght=language::trnaslate('urlLanght',false,'{Langht}',count(url));
                $urlLanght=language::trnaslate($urlLanght,false,'{required}',$this->Settings['requiredUrl'],false);
                $urlLanght=language::trnaslate($urlLanght,false,'{controler}',$this->classname(),false);
                erorrDetect::thrownew('urlLanght',$urlLanght);
            }
        }
    }
    private function setTemplete(){
        if($this->Settings['templete']){
            $getTemplete=$this->classname();
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

