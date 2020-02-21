<?php
namespace core\main\migration\relations;
use  core\main\migration\abstracts\abstract_relation;
class one_to_many extends abstract_relation{
    function run(array $fun_argument,string $table): array
    {
        array_push($this->querys['actual'],$this->FOREIGN_KEY($fun_argument));
        return $this->querys;
    }
}