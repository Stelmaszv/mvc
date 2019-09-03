<?php
namespace controler;
use App\controler;
use App\auth;
class logout extends controler{
     public function addElments(){
         $auth=new auth();
         $auth->logout();
     }

}