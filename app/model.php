<?php
    namespace App;
    use helpels\urls;
    use mysql_xdevapi\Exception;

    class model extends modelCi {
        use \faindTable;
        protected static $table = '';
        protected static $id=0;
        protected static $idName='id';
        protected static $unique='login';
        function __construct(){
            $this->Setings();
            if(!$this->faindTable(self::$table)){
                throw new \Exception(sprintf(' Undefined table in model '.$this->getTemplete().' or table do doesnt exist'));
            }
            $this->sqlProtection();
            //$this->table=$this->sql->escepeString($this->table);

        }
        private function getTemplete(){
            return (new \ReflectionClass($this))->getShortName();
        }
        private function Setings(){
            $this->SetMethods();
        }
        static  function showTableName(){
            return self::$table;
        }
        private function sqlProtection(){
            $sql= new sql();
            self::$table=$sql->escepeString(self::$table);
          // self::$idName=$sql->escepeString(self::$idName);
          //  self::$unique=$sql->escepeString(self::$unique);
         //   self::$id=intval(self::$id);
        }
        static function insert($array){
            $sql= new sql();
            $query='INSERT INTO '.self::$table;
            $query.=self::returnFields($array);
            $query.=self::returnValues($array);
            if($sql->MsQuery($query)){
                return $sql->lostId();
            }
            return 0;
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
            foreach ($loop as $item) {
                if ($item['Field'] !== self::$idName) {
                    foreach ($array as $el) {
                        if($item['Field']==$el['field']){
                            $fields.= ' '.$item['Field'].' ';
                            if($count != count($array)){
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
        /*
        private function faindTable($table){
            $sql= new sql();
            $tableList=$sql->SqlloopAll('SHOW tables');
            foreach ($tableList as $el){
                if($el['Tables_in_test']==$table){
                    return true;
                }
            }
            return false;
        }
        */
        public function SetMethods(){}
        static function faind($id=false){
            self::$id=intval($id);
            return self::where(intval($id),self::$idName,'=');
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
            $sql->MsQuery('DELETE FROM '.self::$table .' WHERE '.self::$idName.'  = '.self::$id);
        }
        static public function updata($id=false,$values){

            self::$id=intval($id);
            $sql= new sql();
            $sqlQuery='UPDATE '.self::$table.' SET';
            $sqlQuery.=self::SetUpdate($values);
            $sqlQuery.=' WHERE '.self::$idName.' ='.self::$id;
            echo $sqlQuery;
            return $sql->MsQuery($sqlQuery);
        }
        static function where($where,$field,$operator){
            $sql= new sql();
            $query = 'SELECT * FROM  ' . self::$table . ' where ' .$sql->escepeString($field). ' ' . $sql->escepeString($operator) . ' "' . $sql->escepeString($where) . '"';
            $equery=$sql->SqlloopAll($query);
            return  $equery;
        }
        function unique($unique=false,$value){
            if($unique) {
                self::$unique = $unique;
            }
            $query=self::where($value,self::$unique,'=');
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
            $usedFields=array();
            foreach ($loop as $field){
                foreach ($values as $data) {
                    if($field['Field']==$data['field']){
                        array_push($usedFields,$field['Field']);
                    }

                }
            }
            foreach ($usedFields as $el){
                foreach ($values as $data) {
                    if($el==$data['field']){
                        if (gettype($data['value']) != 'integer') {
                            $updata .= ' ' . $el . '="' . $sql->escepeString($data['value']) . '" ';
                        }else{
                            $updata .= ' ' . $el . '=' . intval($data['value']) . ' ';
                        }
                        if ($index != count($values)-1) {
                            $updata .= ', ';
                        }
                    }
                }
                $index++;
            }
            return $updata;
        }
    }
?>