<?php
namespace core\main\model\modelValidator;
use core\exception\catch_exception;
use core\db\set_db;
class many_to_many{
    private $table;
    private $table2;
    function __construct($object,$object2){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->table=$object->class_Name();
        $this->table2=$object2->class_Name();
    }
    function valid($value){
        
    }
    function get_objects(){
        $this->tableName='many_to_many_'.$this->table.'_'.$this->table2;
        $sql= 'SELECT * FROM '.$this->tableName.' INNER JOIN '.$this->table.' ON '.$this->tableName.'.id= test2.id INNER join '.$this->table2.' on '.$this->tableName.'.id = '.$this->table2.'.id';
        return $this->db->get_Query_Loop($sql);
    }
}