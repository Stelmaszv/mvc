<?php
namespace controler;
use App\controler;
use App\auth;
class home extends controler{
    function addElments(){
        $this->templete->CIf('!session',!auth::ifAuth());
        $this->templete->CIf('session',auth::ifAuth());
        if(auth::ifAuth()) {
            $this->templete->CIf('admin', auth::ifLevel('admin'));
        }
    }
}