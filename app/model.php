<?php
    namespace App;
    class model extends modelCi {
        public static $table = '';
        public static $id=0;
        public static $idName='id';
        public static $unique='login';
        function __construct(){
            $this->Setings();
            $this->sqlProtection();
            //$this->table=$this->sql->escepeString($this->table);
        }
        private function Setings(){
            $this->SetMethods();
        }
        private function sqlProtection(){
            $sql= new sql();
            self::$table=$sql->escepeString(self::$table);
            self::$idName=$sql->escepeString(self::$idName);
            self::$unique=$sql->escepeString(self::$unique);
            self::$id=intval(self::$id);
        }
        static function insert($array){
            //INSERT INTO `users` (`id`, `login`, `password`, `level`, `email`, `number`) VALUES (NULL, 'gwrg', 'gerg', 'user', 'qwd', '');
            $sql= new sql();
            $query='INSERT INTO '.self::$table;
            $query.=self::returnFields($array);
            $query.=self::returnValues($array);
            return $sql->MsQuery($query);
        }
        private function returnValues($array){
            $values=' VALUES(';
            $count=1;
            foreach ($array as $el) {
                $values.= ' "'.$el['value'].'" ';
                if(count($array)!=$count){
                    $values.=', ';
                }
                $count++;
            }
            $values.=');';
            return $values;
        }
        private function returnFields($array){
            $fieldIninsert=array();
            $sql= new sql();
            $loop = $sql->SqlloopAll('SHOW COLUMNS FROM ' . self::$table);
            $fields=" (";
            $count=1;
            $items=count($loop)-count($array);
            foreach ($loop as $item) {
                if ($item['Field'] !== self::$idName) {
                    foreach ($array as $el) {
                        if($item['Field']==$el['field']){
                            $fields.= ' '.$item['Field'].' ';
                            if($count<=$items-1){
                                $fields.=', ';
                            }
                            $count++;
                        }

                    }
                }

            }
            $fields.=")";
            return $fields;
        }
        public function SetMethods(){}
        static function faind($id=false){
            self::$id=intval($id);
             $sql= new sql();
            return $sql->SqlloopAll('SELECT * FROM '.self::$table .' where '.self::$idName.'  = '.intval($id).'');
        }
        static public function showAll($limit=false){
            $sql= new sql();
            if(!$limit) {
                $array=$sql->SqlloopAll('SELECT * FROM '.self::$table );
            }else{
                $array=$sql->SqlloopAll('SELECT * FROM '.self::$table .' LIMIT '.intval($limit).' ');
            }
            return $array;
        }
        static public function delete($id=false){
            self::$id=intval($id);
            $sql= new sql();
            $sql->MsQuery('DELETE FROM `users` WHERE '.self::$idName.'  = '.self::$id);
        }
        static public function updata($id=false,$values){
            self::$id=intval($id);
            $sql= new sql();
            $sqlQuery='UPDATE '.self::$table.' SET';
            $sqlQuery.=self::SetUpdate($values);
            $sqlQuery.='WHERE '.self::$idName.' ='.self::$id;
            $sql->MsQuery($sqlQuery);
        }
        function unique($unique,$value){
            $sql= new sql();
            self::$unique=$unique;
            $query=$sql->SqlloopAll('SELECT * FROM  '.self::$table.' where '.self::$unique.'= "'.$sql->escepeString($value).'"');
            if(count($query)>0){
                return true;
            }
            return false;

        }
        private function SetUpdate($values){
            $sql = new sql();
            $updata = '';
            $loop = $sql->SqlloopAll('SHOW COLUMNS FROM ' . self::$table);
            $index = 0;
            foreach ($loop as $item) {
                if ($item['Field'] !== self::$idName) {
                    foreach ($values as $el => $value) {
                        if ($el == $item['Field']) {
                            if (gettype($values[$el]) != 'integer') {
                                $updata .= ' ' . $item['Field'] . '="' . $sql->escepeString($values[$el]) . '" ';
                            } else {
                                $updata .= ' ' . $item['Field'] . '=' . intval($values[$el]) . ' ';
                            }
                            if ($index != count($values)) {
                                $updata .= ', ';
                            }
                        }
                    }
                }
                $index++;
            }
            return $updata;
        }
    }
?>