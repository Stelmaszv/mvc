<?php
namespace AppControler;
use CoreMain\controller;
class home extends controller{
    function main(){ }
    function settings(){
        $this->Settings['notemplete']=false;
    }
    function new(){
        echo 'no i dupa';
    }
}

