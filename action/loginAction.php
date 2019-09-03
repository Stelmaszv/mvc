<?php
namespace action;
use App\action;
use App\auth;
class loginAction extends action{
    function execute($array){
        $auth=new auth();
        if(action::issetAction()){
            $auth->faindUsertoLogin($_POST);
        }
    }
}