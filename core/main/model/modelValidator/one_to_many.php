<?php
namespace core\main\model\modelValidator;
use core\db\set_db;
class one_to_many{
    use \relation_valid,\class_Name;
    private $table;
    private $table2;
    function __construct($object,$table){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->table=$table;
        $this->table2=$object->table;
    }
    function valid($value) :vaid
    {
        
    }
    function get_objects() :array 
    {
        $sql= 'SELECT * FROM '.$this->table2.' INNER JOIN '.$this->table.' ON '.$this->table.'.relation_key = '.$this->table2.'.id';
        return $this->db->get_Query_Loop($sql);
    }
}