<?php
namespace app\controllers\home;
use core\main\controller\abstract_controller;
use app\models\{test2,onetoonetest};
use core\db\set_db;
class home_controller extends abstract_controller{
    function main(array $request,object $db){
        $model2=new onetoonetest($db);
        $model2->insert([['colum'=>'text','value'=>'terhst']]);
        //$this->db=new set_db();
        //$this->db=$this->db->get_Engin();
        //$model2=new onetoonetest($this->db);
        //$model->insert([['colum'=>'erg','value'=>'terhst'],['colum'=>'relation_key','value'=>1]]);
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