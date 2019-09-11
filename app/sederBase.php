<?php
namespace App;
use App\sql;
abstract class sederBase{
    public function __construct(){
        $this->sql= new sql();
        $this->prepeare();
    }
    function run(){
        foreach ($this->elments as $el ){
            $el['1']=$this->sql->escepeString($el['1']);
            $el['2']=$this->sql->escepeString($el['2']);
            $el['3']=$this->sql->escepeString($el['3']);
            $el['4']=$this->sql->escepeString($el['4']);
            $query='INSERT INTO '.$this->table.' VALUES (NULL, "'.$el['1'].'","'.$el['2'].'", "'.$el['3'].'", "'.$el['4'].'");';
            $this->sql->MsQuery($query);
        }
        echo 'New '.count($this->elments).' records has been added';

    }
    function execute(){
        $this->run();
    }
}