<?php
class logout extends controler{
     public function addElments(){
         $auth=new auth();
         $auth->logout();
     }
}