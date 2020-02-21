<?php
namespace core\main\migration\relations;
use  core\main\migration\abstracts\abstract_relation;
class many_to_many extends abstract_relation{
    function run(array $fun_argument,string $table): array
    {
        $this->many_to_many($fun_argument,$table);
        return $this->querys;
    }
    private function many_to_many(array $fun_argument,string $table):void
    {
        $relation_name="relaton".$table."".$fun_argument['FOREIGN_KEY_REFERENCES'];
        $relation_one_name="relaton".$table;
        $relation_Two_name="relaton".$fun_argument['FOREIGN_KEY_REFERENCES'];
        $query="CREATE TABLE ".$relation_name."(";
        $query.="id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
        $query.=")";
        array_push($this->querys['added'],$query);
        $query="ALTER TABLE `".$relation_name."` ADD `".$relation_one_name."` INT NULL;";
        $query2="ALTER TABLE `".$relation_name."` ADD `".$relation_Two_name."` INT NULL;";
        array_push($this->querys['added'],$query);
        array_push($this->querys['added'],$query2);
        $query3="ALTER TABLE `".$relation_name."` ADD FOREIGN KEY (".$relation_one_name.") REFERENCES `".$table."`(id);";
        $query4="ALTER TABLE `".$relation_name."` ADD FOREIGN KEY (".$relation_Two_name.") REFERENCES `".$fun_argument['FOREIGN_KEY_REFERENCES']."`(id);";
        array_push($this->querys['added'],$query3);
        array_push($this->querys['added'],$query4);
    }
}