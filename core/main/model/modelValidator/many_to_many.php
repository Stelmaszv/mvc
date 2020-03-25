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
        $this->object=$object;
        $this->object2=$object2;
        $this->table=$object->class_Name();
        $this->table2=$object2->class_Name();
        $this->tableName='many_to_many_'.$this->table.'_'.$this->table2;
    }
    function valid($value){
        $this->object->get_one($value[0]);
        $this->object2->get_one($value[1]);
        $sql='INSERT INTO `many_to_many_test2_onetoonetest` (`id`, `relaton_test2`, `relaton_onetoonetest`) VALUES (NULL,'.intval($value[0]).', '.intval($value[1]).');';
        $this->db->run_Query($sql,'');
    }
    function get_objects(){
        $sql= 'SELECT * FROM '.$this->tableName.' INNER JOIN '.$this->table.' ON '.$this->tableName.'.id= test2.id INNER join '.$this->table2.' on '.$this->tableName.'.id = '.$this->table2.'.id';
        return $this->db->get_Query_Loop($sql);
    }
}