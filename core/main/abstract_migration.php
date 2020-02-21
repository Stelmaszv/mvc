<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
// CREATE TABLE `test`.`querytest` ( `id` INT NOT NULL AUTO_INCREMENT , `mees` INT NOT NULL , `adress` INT NOT NULL , PRIMARY KEY (`id`), FOREIGN KEY (mees) REFERENCES users(id)) ENGINE = InnoDB
// CREATE TABLE IF NOT EXISTS ge(wqg int(100) NOT NULL ,erg2 int(100) NULL ,erg varchar(100) COLLATE utf8_polish_ci NULL  PRIMARY KEY (`wqb`)
//CREATE TABLE IF NOT EXISTS ge(wqg `int` NOT NULL AUTO_INCREMENT  ,erg2 `int` NULL   ,erg varchar(100) COLLATE utf8_polish_ci NULL , PRIMARY KEY (`wqg`), FOREIGN KEY (erg2) REFERENCES users(id))
namespace core\main;
use core\db\db;
class one_to_many extends relation{
    function run(array $fun_argument,string $table): array
    {
        array_push($this->querys['actual'],$this->FOREIGN_KEY($fun_argument));
        return $this->querys;
    }
}
class one_to_one extends relation{
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

class many_to_many extends relation{
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
