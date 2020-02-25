<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use CoreMain\form;
use Corehelpel\urls;
class showuser extends controller{
    private $array;
    private $form;
    private $users;
    private $Editsucess;
    public function onConstract(){ 
        $this->users=new users;
        $this->array=$this->users::faind(url[2]);
    }
    public function main(){
        $this->addelemts();
    }
    public function edit(){
        $this->templete->CIf('error',isset($_GET['error']));
        $this->addelemts();
        $this->templete->CLoop('errors', array());
    }
    public function settings(){
        switch(method){
            case 'edit':
                $this->Settings['templeteshema']=setconrollerShema('edituser');
            break; 
            case 'delete':
                 $this->Settings['templete']=false;
            break; 
        }
    }
    public function onPost(){
        $this->form=new form(array(
            'login'=>array('name'=>'login','require'=>true,'max'=>50,'min'=>5,'type'=>'text','value'=>$_POST['login'],'stan'=>false,'login'=>true,'db'=>'login','unique'=>array(new users(),'login'),'erros'=>array()),
            'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>$_POST['email'],'db'=>'email','stan'=>false,'erros'=>array()),
            'avatar'=>array('name'=>'avatar','require'=>false,'type'=>'file','value'=>$_FILES['avatar'],'db'=>'avatar','stan'=>false,'fileSettings'=>array('maxsize'=>500000,'ext'=>array('jpg','jpeg','png','svg','gif'),'url'=>'app/usersData/'.url[2],'newName'=>$this->array['login'].'-avatar-'.$this->array['id']),'erros'=>array()),
        ));
        if($this->form->validate()){
            if(users::updata(url[2],$this->form->readyTosent())){
                $this->form->upload();
                urls::addToIssetUrl('?error');
            }
        }
        if($this->form->showErors()){
            $this->templete->CLoop('errors', $this->form->showErors());
        }else{
            $this->templete->CLoop('errors', array());
        }
        
    }
    public function delete(){
        $this->users::delete(url[2]);
        urls::setLocation('showUsers');
    }
    private function addelemts(){
        $this->templete->CAdd('[#LOGIN#]',$this->array['login']);
        $this->templete->CAdd('[#EMAIL#]',$this->array['email']);
        $this->templete->CAdd('[#LEVEL#]',$this->array['level']);
        $this->templete->CAdd('[#avatar#]',$this->array['avatar']);
    }

}