<?php
namespace App;
use App\actionlist;
use action\loginAction;
use action\registerAction;
class actionPost extends actionlist{
    function execute($array){
        $action=[];
        $action['loginStart']= new loginAction($array);
        $action['register']= new registerAction($array);
        $action[$this->action]->execute($array);
    }
}