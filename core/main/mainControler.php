<?php
namespace CoreMain;
use CoreErorr\erorrDetect;
use CoreMain\controller;
use Corelanguage\language;
class mainControler extends controller{
    private $controler;
    use \className;
    function __construct($controler){
        $this->controler=$controler;
        $this->Settings=config['defultController'];
        $this->templete = new CTemplate('public/index.htm');
        $this->init();
    }
    function main(){
        $this->templete->CAdd('[#viev#]',$this->controler->render());
    }
    function init(){
        if(url){
            if(!isset(url[1])){
                $this->controler->main();
            }else{
              $function=url[1];
              if(method_exists($this->controler,$function)){
                $this->controler->$function();
              }else{
               // $ControlerMethodError=language::trnaslate('ControlerMethodError',false,'{function}',$function);
               // $ControlerMethodError=language::trnaslate($ControlerMethodError,false,'{controler}',$this->classname(),false);
               // erorrDetect::thrownew('ControlerMethodError',$ControlerMethodError);
              }
            }
        }else{
            $this->controler->main();
        }
    }
    function show(){
        $this->main();
        if($this->Settings['templete']){
            return $this->render();
        }
        
    }
}

