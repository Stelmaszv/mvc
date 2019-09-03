<?php
    namespace App;
    class model extends modelCi {
        var $table;
        private $sql;
        public function __construct(){
            $this->sql=new sql();
            $this->Setings();
            $this->table=$this->sql->escepeString($this->table);
        }
        function Setings(){}
        function faind($id,$idFieldName=false){
            $this->Setings();
            if(!$idFieldName){
                $idFieldName='id';
            }
            return $this->sql->SqlloopAll('SELECT * FROM '.$this->table .' where '.$idFieldName.'  = '.intval($id).'');
        }
        public function showAll($limit=false){
            $array=[];
            if(!$limit) {
                $array=$this->sql->SqlloopAll('SELECT * FROM '.$this->table );
            }else{
                $array=$this->sql->SqlloopAll('SELECT * FROM '.$this->table .' LIMIT '.intval($limit).' ');
            }
            return $array;
        }
    }
?>