<?php
namespace core\main\migration\abstracts;
use core\db\interfaces\db_interface as DB;
abstract class abstract_Value{
    protected $column='';
    protected $db;
    protected $change;
    protected $type;
    function __construct(DB $db){
        $this->db=$db;
    }
    protected function setNull(array $null) : string
    {
        if (!isset($null['NULL'])){
            return 'NULL';
        }
        return $null['NULL'];
    }
    protected function if_AUTO_INCREMENT(array $arguments) : string
    {
        if (isset($arguments['AUTO_INCREMENT'])){
            return 'AUTO_INCREMENT';
        }
        return '';
    }
    protected function return_Field(array $fun_argument) : array
    {
        return $this->db->return_Colum($fun_argument['object']->table,$fun_argument['argument']['name'],$fun_argument['object']->item);
    }
    protected function if_Available(array $fun_argument) : bool
    {
        return $this->db->faind_Column($fun_argument['object']->table,$fun_argument['argument']['name']);
    }
    protected function Alter_Shema(array $fun_argument) : string
    {
        $query='';
        $name=$this->return_Field($fun_argument);
        if (!$this->if_Available($fun_argument) && $name['Field'] != $fun_argument['argument']['name']){
            if(count($name)){
                $query = " ALTER TABLE `".$fun_argument['object']->table."` CHANGE `".$name['Field']."` `".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->setNull($fun_argument['argument'])."; ";
            }else{
                $query = " ALTER TABLE `".$fun_argument['object']->table."` ADD `".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->setNull($fun_argument['argument'])."; ";
            }
        }
        return $query;
    } 
    function Alter(array $fun_argument) : string
    {
        return $this->Alter_Shema($fun_argument);
    }
    function Create(array $fun_argument): string
    {
        return "`".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->if_AUTO_INCREMENT($fun_argument['argument'])."   ";
    }
}