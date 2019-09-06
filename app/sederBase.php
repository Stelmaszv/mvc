<?php
namespace App;
use App\sql;
use App\randomUserData;
abstract class sederBase{
    public function __construct(){
        $this->sql= new sql();
        $this->randomUser= new randomUserData(0);
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




        //$query='INSERT INTO '.$this->table.' (`id`,'.$this->elments[0]['field'].', '.$this->elments[1]['field'].','.$this->elments[2]['field'].','.$this->elments[3]['field'].') VALUES (NULL, "'.$this->elments[0]['value'].'","'.$this->elments[1]['value'].'", "'.$this->elments[2]['value'].'", "'.$this->elments[3]['value'].'");';
       //$this->sql->MsQuery($query);
    }
    function execute(){
        $this->run();
        /*
        for ($x = 0; $x <= $this->items; $x++) {
            $this->prepeare();
            $this->run();
        }
        */
    }
}