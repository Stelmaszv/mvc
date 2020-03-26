<?php
namespace core\main\model\modelValidator;
use core\db\set_db;
class one_to_one{
    use \relation_valid;
    private $table;
    function __construct($object,$table){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->table=$table;
    }
    function valid($value) : void
    {
        $arguments=[
            'value'  =>$value,
            'table'  =>$this->table,
        ];
        $this->faind_in_table('one_to_one',$arguments);
    }
    function get_objects() :array 
    {
        $sql= 'SELECT * FROM '.$this->table2.' INNER JOIN '.$this->table.' ON '.$this->table.'.relation_key = '.$this->table2.'.id';
        return $this->db->get_Query_Loop($sql);
    }
}