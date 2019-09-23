<?php
namespace App;
class actionControler extends action {
    function __construct($actions){
        $this->action=$actions;
    }
    function execute(){
        $this->action->execute();
    }
}
