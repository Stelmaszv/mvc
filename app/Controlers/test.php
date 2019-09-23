<?php
namespace AppControler;
use CoreMain\controller;
class test extends controller{
    function main(){

    }
    function settings(){
        $this->Settings['notemplete']=true;
    }
    function dupa(){
        echo 'qd';
    }
}

