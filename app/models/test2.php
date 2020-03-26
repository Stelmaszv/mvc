<?php
namespace app\models;
use core\main\model\abstract_model;
use app\models\onetoonetest;
class test2 extends abstract_model{
    function validate() :void
    {
        $this->add([
            'colum'    => 'erg',
            'type'     => $this->varchar(),
            'relation' => FALSE
        ]);
        $this->add([
            'colum'    => 'relation_key',
            'type'     => $this->one_to_one($this,'onetoonetest'),
            'relation' => false
        ]);
    }
}