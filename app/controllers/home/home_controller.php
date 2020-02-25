<?php
namespace app\controllers\home;
use core\main\controller\abstract_controller;
class home_controller extends abstract_controller{
    function main(array $request){
        \vd($request);
    }
    function test(array $request){
        \vd($request);
    }    
    function test2(){
        echo 'jryi6i67ij';
    }    
}