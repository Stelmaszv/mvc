<?php
namespace core\main\model\modelValidator;
use core\exception\catch_exception;
use core\db\set_db;
class many_to_many{
    use \relation_valid;
    private $table;
    private $table2;
    function __construct($object,$table){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->table1=$table;
        $this->table2=$object->class_Name();
        $this->tableName='many_to_many_'.$this->table1.'_'.$this->table2;
    }
    function valid($value){
        $arguments=[
            'value'   => $value,
            'table'   => $this->table1,
            'table2'  => $this->table2,
        ];
        $this->faind_in_table('many_to_many',$arguments);
        $sql='INSERT INTO `many_to_many_test2_onetoonetest` (`id`, `relaton_test2`, `relaton_onetoonetest`) VALUES (NULL,'.intval($value[0]).', '.intval($value[1]).');';
        $this->db->run_Query($sql,'');
    }
    function get_objects(){
        $sql= 'SELECT * FROM '.$this->tableName.' INNER JOIN '.$this->table.' ON '.$this->tableName.'.id= test2.id INNER join '.$this->table2.' on '.$this->tableName.'.id = '.$this->table2.'.id';
        return $this->db->get_Query_Loop($sql);
    }
}