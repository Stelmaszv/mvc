<?php
namespace action;
use App\action;
use app\auth;
class registerAction extends action{
    function execute($array){
        $auth=new auth();
        $auth->register($_POST);
    }

}