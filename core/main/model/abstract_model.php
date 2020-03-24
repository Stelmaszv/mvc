<?php
namespace core\main\model;
use core\db\set_db;
use core\main\model\modelValidator\{varchar,many_to_many};
use core\exception\catch_exception;
abstract class abstract_model{
    use \class_Name;
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
    private function faind_colum_in_table(string $field) : array
    {
        $colum=[];
        foreach($this->setings as $item){
            if($item['colum']==$field){
                $colum=$item;
            }
        }
        return $colum;
    }
    private function add_if_not_exist(array $item,string $insert,string $key,bool $valid) : void
    {
        $count=0;
        foreach($this->insert[$insert] as $add){
            if($add == $item[$key]){
                $count=1;
            }
        }
        if(!$count){
            if($valid){
                \vd($item[$key]);
                $colum=$this->faind_colum_in_table($item['colum']);
                $colum['type']->valid($item[$key]);
            }
            array_push($this->insert[$insert],$item[$key]);
        }

    }
    public function insert(array $array) : void
    {
        $this->insert=['columns'=>[],'values'=>[]];
        $count=count($this->db->show_Columns($this->table))-1;
        foreach($array as $item){
            $this->add_if_not_exist($item,'columns','colum',false);
            $this->add_if_not_exist($item,'values','value',true);
        }
        $insertQuery='INSERT INTO '.$this->table.' (';
        $index=0;
        foreach($this->insert['columns'] as $colum){
            $insertQuery.= $colum;
            if($index<count($this->insert['columns'])-1){
                $insertQuery.= ' , ';
            }
            $index++;
        }   
        $insertQuery.= ') VALUES (';
        $index=0;  
        foreach($this->insert['values'] as $value){
            if(is_string($colum)){
                $insertQuery.= "'$value'";
            }else{
                $insertQuery.= $value;
            }
            if($index<count($this->insert['values'])-1){
                $insertQuery.= ' , ';
            }
            $index++;
        } 
        $insertQuery.= ')'; 
        echo $this->db->run_Query($insertQuery,'');
    }
    public function get_one(int $id) : array
    {   
        $sql='SELECT * FROM '.$this->table.' WHERE id = '.intval($id);
        return $this->db->get_Query_Loop($sql)[0];
    }
    public function get_many_to_many(string $field) : array
    {
        foreach($this->setings as $relation){
            if($field==$relation['colum']){
                if(!method_exists($relation['type'], 'get_objects')){
                    catch_exception::throw_New('Colum '.$relation['colum'].' dont have relation many to many',true);
                }
                return $relation['type']->get_objects();
            }
        }
    }
    public function varchar() : varchar
    {
        return new varchar();
    }
    public function many_to_many(abstract_model $relation,abstract_model $relation2) : many_to_many
    {
        return new many_to_many($relation,$relation2);
    }
}