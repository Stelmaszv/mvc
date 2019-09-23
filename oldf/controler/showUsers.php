<?php
namespace controler;
use App\controler;
use App\debag;
use App\pagination;
use App\form;
use model\users;

class showUsers extends controler{
    private function pagination(){
        $this->pagination=new pagination(30,$_GET);
        $this->pagination->setSql('SELECT * FROM `users`');
    }
    public function addElments(){
        $this->pagination();
       $this->templete->CLoop('users',$this->pagination->loop);
       $this->templete->CLoop('pages',$this->pagination->returnPages(10));
       $this->templete->CAdd('[#back#]',$this->pagination->ifBack());
       $this->templete->CAdd('[#next#]',$this->pagination->ifNext());
       $this->templete->CIf('back',$this->pagination->back);
       $this->templete->CIf('next',$this->pagination->next);
       $this->templete->CAdd('[#first#]',$this->pagination->returnFirst());
       $this->templete->CAdd('[#lost#]',$this->pagination->returnLost());
       $this->templete->CAdd('[#lostNumber#]',$this->pagination->pagesCount);
    }
    public function onPost(){
        $user=new users();
       $from=new form(array(
           'login'=>array('name'=>'login','require'=>true,'max'=>50,'min'=>5,'type'=>'text','value'=>'stelmaszv','stan'=>false,'login'=>true,'db'=>'login','unique'=>array(new users(),'login')),
           'password'=>array('name'=>'password','require'=>false,'max'=>50,'min'=>6,'type'=>'password','value'=>'Samlogan007!!','db'=>'password','stan'=>false),
           'passwordconfirm'=>array('name'=>'passwordconfirm','require'=>false,'max'=>50,'min'=>6,'type'=>'password','value'=>'Samlogan007!!','stan'=>false,'passwordConfirm'=>true),
           'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>'stelmaszv@gmail.com','db'=>'email','stan'=>false)
       ));
       if($from->validate()){
            if($user::insert($from->readyTosent())){
                echo 'dodanie sie udało :)';
            }
       }else{
           $this->templete->CLoop('errors',$from->showErors());
       }


    }
}
