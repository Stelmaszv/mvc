<?php
namespace App;
use App\sql;
class migrate{
    public function __construct(){
        $this->sql= new sql();
        $this->migrationlist();
        $this->run();
    }
    private function migrationlist(){
        $this->migrationArray[0]=array(
            'table'=> 'users',
            'query'=> 'CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)'
        );
    }
    private function run(){
        $index=0;
        foreach($this->migrationArray as $query){
            if($this->sql->MsQuery($this->migrationArray[$index]['query'])){
                echo 'Table '.$this->migrationArray[$index]['table'].' has been created ';
            }

        }
    }
}