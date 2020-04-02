<?php
namespace core\main\model;
use core\main\model\abstract_model; 
class search_model{
    private $model;
    function __construct(abstract_model $abstract_model){
        $this->model=$abstract_model;
    }
    function return_fields_list() :array
    {
        return $this->model->setings;
    }
}