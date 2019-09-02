<?php
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
