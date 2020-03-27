<?php
namespace core\main\migration;
use core\main\migration\abstracts\abstract_migration;
class migration_search{
    private $migration;
    private $migration_sheama;
    function __construct(abstract_migration $migration){
        $this->migration=$migration;
        $this->migration_sheama=$this->migration->return_query_argumants();
    }
    public function faind_fields_typs(string $fields) : array{
        $items=[];
        foreach($this->migration_sheama as $item){
            foreach($item as $argumants){
                if(is_array($argumants)){
                    array_push($items,$argumants);
                }
            }
        }
        return $items;
    }
    public function return_fields_list(){
        return $this->migration_sheama;
    }
}