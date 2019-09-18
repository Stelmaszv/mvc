<?php
namespace controler;
use app\controler;
use App\auth;
class login extends controler{
    public function addElments(){
        $this->templete->CIf('error',false);
    }
    public function onPost(){
        $auth=new auth($_POST);
        $auth->loginStart();
    }
    public function onError(){
        $this->templete->CIf('error',true);
    }
}