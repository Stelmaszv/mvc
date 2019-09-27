<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\authModel;
use CoreMain\form;
use Corehelpel\urls;
use CoreMain\auth;
class register extends controller{
    function main() { 
        $this->templete->CLoop('errors', array());
    }
    function onPost(){
        $from=new form(array(
            'login'=>array('name'=>'login','require'=>true,'max'=>50,'min'=>5,'type'=>'text','value'=>$_POST['login'],'stan'=>false,'login'=>true,'db'=>'login','erros'=>array(),'unique'=>array(new authModel(),false)),
            'password'=>array('name'=>'password','require'=>true,'max'=>50,'min'=>6,'type'=>'password','value'=>$_POST['password'],'db'=>'password','stan'=>false,'erros'=>array()),
            'passwordconfirm'=>array('name'=>'passwordconfirm','require'=>true,'max'=>50,'min'=>6,'type'=>'password','value'=>$_POST['passwordconfirm'],'stan'=>false,'passwordConfirm'=>true,'erros'=>array()),
            'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>$_POST['email'],'db'=>'email','stan'=>false,'erros'=>array())
        ));
        if($from->validate()){
            $auth=new auth($from->readyTosent());
            $auth->register();
        }else{
            $this->templete->CLoop('errors',$from->showErors());
        }
    }
}
