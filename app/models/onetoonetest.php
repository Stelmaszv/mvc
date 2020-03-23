<?php
namespace app\models;
use core\main\model\abstract_model;
class onetoonetest extends abstract_model{
    function validate() :void
    {
        $this->add([
            'type' => $this->varchar()
        ]);
    }
}