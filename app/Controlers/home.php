<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
class home extends controller{
    function main() { 
        new users();
    }
    function settings(){
        $this->Settings['notemplete']=false;
    }
    function new(){
        echo 'no i dupa';
    }
}

