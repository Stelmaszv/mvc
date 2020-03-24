<?php
namespace app\controllers\home;
use core\main\controller\abstract_controller;
use app\models\{test2,onetoonetest};
class home_controller extends abstract_controller{
    function main(array $request){
        $model=new test2();
        $model2=new onetoonetest();
        \vd($model->get_one(1));
        $model->insert([['colum'=>'erg','value'=>'terhst'],['colum'=>'relation_key','value'=>[1,1]]]);
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