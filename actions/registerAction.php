<?php
class registerAction extends action{
    function execute($array){
        $auth=new auth();
        $auth->register($_POST);
    }

}