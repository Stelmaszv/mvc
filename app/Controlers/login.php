<?php
namespace AppControler;
use CoreMain\controller;
use CoreMain\auth;
class login extends controller{
    function main(){
        $this->templete->CLoop('error',array());
    }
    public function onPost(){
        $auth=new auth($_POST);
        $array=$auth->loginStart();
        if($array[0]['sucess']){
            $auth->setSession($array[0]['sucess']);
        }else{
            $this->templete->CLoop('error',$array);
        }
    }
}