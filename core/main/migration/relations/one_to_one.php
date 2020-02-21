<?php
namespace core\main\migration\relations;
use  core\main\migration\abstracts\abstract_relation;
class one_to_one extends abstract_relation{
    function run(array $fun_argument,string $table): array
    {
        $this->one_to_one($fun_argument,$table);
        array_push($this->querys['actual'],$this->FOREIGN_KEY($fun_argument));
        return $this->querys;
    }
    private function one_to_one(array $fun_argument,string $table):void
    {
        $field_Name=$table;
        $query="ALTER TABLE `".$fun_argument['FOREIGN_KEY_REFERENCES']."` ADD `".$field_Name."` INT NOT NULL;";
        $query2="ALTER TABLE `".$fun_argument['FOREIGN_KEY_REFERENCES']."` ADD FOREIGN KEY (".$field_Name.") REFERENCES `".$table."`(".$fun_argument['FOREIGN_KEY_VALUE'].");";
        array_push($this->querys['added'],$query);
        array_push($this->querys['added'],$query2);
    }
}