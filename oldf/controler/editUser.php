<?php
namespace controler;
use App\debag;
use App\urls;
use controler\showUser;
use model\users;
use App\form;
class editUser extends showUser{
    public function onConstruct(){
        $this->templete->CIf('notification',$this->onIssetGet('notification'));
        $this->templete->CLoop('errors', array());
    }
   public function onPost(){
       $user=new users();
       $this->array=$user::faind($_GET['id'])[0];
       $this->form=new form(array(
           'login'=>array('name'=>'login','require'=>true,'max'=>50,'min'=>5,'type'=>'text','value'=>$_POST['login'],'stan'=>false,'login'=>true,'db'=>'login','unique'=>array(new users(),'login'),'erros'=>array()),
           'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>$_POST['email'],'db'=>'email','stan'=>false,'erros'=>array()),
           'avatar'=>array('name'=>'avatar','require'=>true,'type'=>'file','value'=>$_FILES['avatar'],'db'=>'avatar','stan'=>false,'fileSettings'=>array('maxsize'=>500000,'ext'=>array('jpg','jpeg','png','svg','gif'),'url'=>'usersData/'.$_GET['id'],'newName'=>$this->array['login'].'-avatar-'.$this->array['id']),'erros'=>array()),
       ));
       \helpels\debag::varDump($this->form->showErors());
       if($this->form->validate()){
           if($user::updata($_GET['id'],$this->form->readyTosent())){
               $this->form->upload();
               $url=new urls();
               $url->addToIssetUrl('&&notification');
               $url->redirect();
           }
       }
       $this->templete->CLoop('errors', $this->form->showErors());
   }
}