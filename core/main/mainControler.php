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
        $this->templete->CAdd('[#title#]',$this->controler->Settings['title']);
        $this->templete->CAdd('[#js#]',$this->addMedia('js'));
        $this->templete->CAdd('[#css#]',$this->addMedia('css'));
    }
    private function addElemnt($templete,$check,$array,$name){
        if(!$check){
            if(count($array)){
                $templete->CLoop($name,$array);
            }
        }
    }
    private function addMedia($el){
        if(!$this->controler->Settings['no'.$el]){
            $templete = new CTemplate('core/templete/'.$el.'.htm');
            $this->addElemnt($templete,$this->controler->Settings[$el]['nourls'],$this->controler->Settings[$el]['url'],'urls');
            $this->addElemnt($templete,$this->controler->Settings[$el]['noassets'],$this->controler->Settings[$el]['assets'],'assets');
            $this->addElemnt($templete,$this->controler->Settings[$el]['nopublic'],$this->controler->Settings[$el]['public'],'public');
            $this->addElemnt($templete,!$this->controler->Settings[$el]['custume'],$this->controler->Settings[$el]['custume'],'custume');
            return $templete->CGet();
        }
    }   
    function init(){
        if(isset(url[1])){
            $function=url[1];
            if(method_exists($this->controler,$function)){
                $this->controler->$function();
            }else{
                $ControlerMethodError=language::trnaslate('ControlerMethodError',false,'{function}',$function);
                $ControlerMethodError=language::trnaslate($ControlerMethodError,false,'{controler}',url[0],false);
                erorrDetect::thrownew('ControlerMethodError',$ControlerMethodError);
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

