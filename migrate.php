<?php
include 'setings.php';
require 'vendor/autoload.php';
use App\sql;
class migrate{
    private $queries=array();
    public function __construct(){
        $this->sql= new sql();
        $this->migrationlist();
        $this->run();
    }
    private function migrationlist(){
        $this->queries[0] = 'CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)';
    }
    private function run(){
        $index=0;
        foreach($this->queries as $query){
            $this->sql->MsQuery($this->queries[$index]);
            $index++;
        }
    }
}
new \migrate();








/*
include 'setings.php';
include 'Include.php';
$queries = [];
$queries[0] = 'CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(50) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)';
$sql = new sql();
$index = 0;
foreach($queries as $query){
    $sql->MsQuery($queries[$index]);
    $index++;
}
header('Location:'.homeLocation);
*/
