<?php
namespace controler;
use App\controler;
use model\users;
class showUsers extends controler{
    public function addElments(){
       $user=new users();
       $this->templete->CLoop('users',$user->showAll());
    }
}