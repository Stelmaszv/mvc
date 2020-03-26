<?php
namespace app\models;
use core\main\model\abstract_model;
use app\models\test2;
class onetoonetest extends abstract_model{
    function validate() :void
    {
        $this->add([
            'colum'    => 'text',
            'type'     => $this->varchar(),
            'relation' => false
        ]);
        $this->add([
            'colum'    => 'relation_key',
            'type'     => $this->many_to_many($this,'test2'),
            'relation' => true
        ]);
    }
}