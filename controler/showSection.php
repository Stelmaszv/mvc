<?php
namespace controler;
use app\controler;
use app\auth;
class  showSection extends controler{
    public function addElments(){
           $this->templete->CAdd('[#Session#]',auth::returnAuth()['login']);
    }
}
