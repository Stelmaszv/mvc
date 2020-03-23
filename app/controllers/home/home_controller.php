<?php
namespace app\controllers\home;
use core\main\controller\abstract_controller;
use app\models\test2;
class home_controller extends abstract_controller{
    function main(array $request){
        new test2();
        /*
        $this->onPost('submit','form',[]);
        echo $this->render('app/controllers/home/index.html',[
            '{{text}}'     =>   'tryj2',
            '{{textf}}'    =>   'tryj',
            '{{loopTest}}' =>   [['name'=>'kot'],['name'=>'pies']]
        ]);
        */
    }
    function form(array $attributes,array $posts){
        //\vd($posts);
    }
    function test(array $request){
        $this->render('index.html',[]);
    }     
}