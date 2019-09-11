<?php
namespace App;
use seeds\addUser;
class sedder{
    public function __construct($el){
        $this->elements($el);
    }
    function elements($el){
        $elmentse=[];
        $elmentse[0]=new addUser(20);
        $elmentse[$el]->execute();
    }
}