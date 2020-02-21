<?php
namespace core\main\migration;
class migrationinit{
    function __construct(array $migrations){ 
        $this->migrations=$migrations;
    }
    public function migrate(){
        foreach($this->migrations as $el){
            $el->run();
        }
    }
}