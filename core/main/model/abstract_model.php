<?php
namespace core\main\model;
abstract class abstract_model{
    use \class_Name;
    public function __construct(){
        $this->table=$this->class_Name();
        $this->setings();
    }
    protected abstract function setings();
}