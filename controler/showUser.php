<?php
namespace controler;
use App\controler;
use App\debag;
use model\users;
class showUser extends controler{
    public function addElments(){
        $users=new users();
        $this->array=$users::faind($_GET['id'])[0];
        if($this->array){
            $this->templete->CAdd('[#login#]',$this->array['login']);
            $this->templete->CAdd('[#email#]',$this->array['email']);
            $this->templete->CAdd('[#level#]',$this->array['level']);
        }else{
            echo 'dqwd';
        }
    }

}