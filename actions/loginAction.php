<?php
class loginAction extends action{
    function execute($array){
        $auth=new auth();
        if(action::issetAction()){
            $auth->faindUsertoLogin($_POST);
        }
    }
}