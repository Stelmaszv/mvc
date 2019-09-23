<?php
namespace CoreMain;
use CoreErorr\erorrDetect;
use CoreMain\controller;
class mainControler extends controller{
    private $controler;
    function __construct($controler){
        $this->controler=$controler;
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
                erorrDetect::thrownew('controlerErorr','Method  '.$function.' in controler '.$name.' does not exist');
              }
            }
        }else{
            $this->controler->main();
        }
    }
    function show(){
        if(!$this->controler->Settings['notemplete']){
             return $this->render();
        }
    }
}

