<?php
namespace App;
class seaderControler {
    public function __construct($name){
        $this->obj=$name;
    }
    function execute(){
        $this->obj->execute();
    }

}