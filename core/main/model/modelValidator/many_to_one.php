<?php
namespace core\main\model\modelValidator;
use core\db\set_db;
class many_to_one{
    use \relation_valid;
    private $table;
    function __construct($object,$table){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->object=$object;
        $this->table=$table;
    }
    function valid($value){
        $arguments=[
            'value'  =>$value,
            'table'  =>$this->table,
        ];
        $this->faind_in_table('many_to_one',$arguments);
    }
}