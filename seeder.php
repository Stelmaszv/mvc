<?php
include 'setings.php';
require 'vendor/autoload.php';
use seeds\addUser;
class sedder{
    private $elemnts;
    function elements($el){
        $elmentse=[];
        $elmentse[0]=new addUser(20);
        $elmentse[$el]->execute();
    }
}
$seder=new \sedder();
$seder->elements(0);