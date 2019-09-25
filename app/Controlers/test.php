<?php
namespace AppControler;
use CoreMain\controller;
class test extends controller{
    function main(){
        $this->templete->CAdd('[#ERORR#]','qwd');
    }
    function settings(){
        //$this->Settings['notemplete']=true;
    }
    function dupa(){
        echo 'qd';
    }
}

