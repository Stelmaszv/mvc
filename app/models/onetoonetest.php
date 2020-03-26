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
            'colum'    => 'test2',
            'type'     => $this->one_to_one($this,'test2'),
            'relation' => false
        ]);
    }
}