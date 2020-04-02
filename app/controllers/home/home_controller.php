<?php
namespace app\controllers\home;
use core\main\controller\abstract_controller;
use app\models\{test2,onetoonetest};
use core\db\set_db;
use core\main\form\form_model;
class home_controller extends abstract_controller{
    function main(array $request,object $db){
        $this->model=new onetoonetest($db);
        $form = new form_model($this->model,0,'submit','POST');
        echo $this->render('app/controllers/home/home_templete.php',[
            'text'     =>   'kot',
            'textf'    =>   'tryj',
            'form'     =>   $form,
             'loopTest' =>   [['name'=>'kot'],['name'=>'pies']]
        ]);
        $this->onPost('submit','form',[]);
        //$model2=new onetoonetest($db);
        //$model2->insert([['colum'=>'text','value'=>'terhst'],['colum'=>'test2','value'=>1]]);
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
    protected function form(array $attributes,array $posts){
        $this->model->insert([['colum'=>'text','value'=>$posts['text']],['colum'=>'test2','value'=>$posts['test2']]]);
    }
    function test(array $request){
        $this->render('index.html',[]);
    }     
}