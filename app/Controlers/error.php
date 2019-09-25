<?php
namespace AppControler;
use CoreMain\controller;
class error extends controller{
    function main(){ 
        $this->templete->CAdd('[#ERROR#]',$_SESSION[url[2]]);
    }
}

