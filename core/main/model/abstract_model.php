<?php
namespace core\main\model;
use core\db\set_db;
use core\main\model\modelValidator\{varchar,relation_one_to_many};
abstract class abstract_model{
    use \class_Name,\array_manipulation;
    private $db;
    private $table;
    protected $setings=array();
    public function __construct(){
        $this->db=new set_db();
        $this->db=$this->db->get_Engin();
        $this->table=$this->class_Name();
        $this->validate();
    }
    protected abstract function validate() : void;
    public function getAll() : array
    {
        return $this->db->get_Query_Loop('SELECT * FROM '.$this->table.'');
    }
    public function add(array $array) : void 
    {
        array_push($this->setings,$array);
    }
    public function insert(array $array) : void
    {

        $insert=['columns'=>[],'values'=>[]];
        $count=count($this->db->show_Columns($this->table))-1;
        foreach($this->setings as $valid){
            foreach($array as $item){
                if($this->db->faind_Column($this->table,$item['colum'])){
                    if($this->add_if_not_exist($insert['columns'],['limit'=>$count,'value'=>$item['colum']])){
                        array_push($insert['columns'],$item['colum']);
                    }
                    if($this->add_if_not_exist($insert['values'],['limit'=>$count,'value'=>$item['colum']])){
                        array_push($insert['values'],$item['value']);
                    }
                }
            }
        }
        $insertQuery='INSERT INTO '.$this->table.' (';
        $index=0;
        foreach($insert['columns'] as $colum){
            $insertQuery.= $colum;
            if($index<count($insert['columns'])-1){
                $insertQuery.= ' , ';
            }
            $index++;
        }   
        $insertQuery.= ') VALUES (';
        $index=0;  
        foreach($insert['values'] as $value){
            if(is_string($colum)){
                $insertQuery.= "'$value'";
            }else{
                $insertQuery.= $value;
            }
            if($index<count($insert['values'])-1){
                $insertQuery.= ' , ';
            }
            $index++;
        } 
        $insertQuery.= ')'; 
        echo $this->db->run_Query($insertQuery,'');
    }
    public function varchar() : varchar
    {
        return new varchar();
    }
    public function relation_one_to_many(abstract_model $object) : relation_one_to_many
    {
        return new relation_one_to_many($object);
    }
}