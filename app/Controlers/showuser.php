<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
class showuser extends controller{
    function main(){
        new users;
        $this->array=users::faind(url[2]);
        $this->addelemts();
    }
    function settings(){
        $this->Settings['requiredUrl']=3;
    }
    protected function addelemts(){
        $this->templete->CAdd('[#LOGIN#]',$this->array['login']);
        $this->templete->CAdd('[#EMAIL#]',$this->array['email']);
        $this->templete->CAdd('[#LEVEL#]',$this->array['level']);
        $this->templete->CAdd('[#avatar#]',$this->array['avatar']);
    }
}