<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use AppControler\showUser;
use CoreMain\form;
use Corehelpel\urls;
class edituser extends showUser{
    function main(){
        parent::main();
    }
    function onPost(){
        $user=new users();
        $this->array=$user::faind(url[2]);
        $this->form=new form(array(
            'login'=>array('name'=>'login','require'=>true,'max'=>50,'min'=>5,'type'=>'text','value'=>$_POST['login'],'stan'=>false,'login'=>true,'db'=>'login','unique'=>array(new users(),'login'),'erros'=>array()),
            'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>$_POST['email'],'db'=>'email','stan'=>false,'erros'=>array()),
            'avatar'=>array('name'=>'avatar','require'=>true,'type'=>'file','value'=>$_FILES['avatar'],'db'=>'avatar','stan'=>false,'fileSettings'=>array('maxsize'=>500000,'ext'=>array('jpg','jpeg','png','svg','gif'),'url'=>'app/usersData/'.url[2],'newName'=>$this->array['login'].'-avatar-'.$this->array['id']),'erros'=>array()),
        ));
        if($this->form->validate()){
            if($user::updata(url[2],$this->form->readyTosent())){
                $this->form->upload();
                $url=new urls();
                $url::refresh();
            }
        }
        echo count($this->form->showErors());
        if($this->form->showErors()){
            $this->templete->CLoop('errors', $this->form->showErors());
        }else{
            $this->templete->CLoop('errors', array());
        }
    }
}