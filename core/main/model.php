<?php
    namespace CoreMain;
    use CoreMain\modelCi;
    use helpels\urls;
    use mysql_xdevapi\Exception;
    use CoreMain\sql;
    use CoreErorr\erorrDetect;
    use Corelanguage\language;
    abstract class model implements modelCi {
        use \faindTableT,\classname;
        protected static $table = '';
        protected static $id=0;
        protected static $idName='id';
        protected static $unique='login';
        function __construct(){
            $this->Setings();
            if(!$this->faindTable(self::$table)){
                $ModeltableError=language::trnaslate('ModeltableError',false,'{model}',$this->classname());
                erorrDetect::thrownew('ModeltableError',$ModeltableError);
            }
            $this->sqlProtection();
        }
        abstract function Setings();
        static  function showTableName(){
            return self::$table;
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
        public function SetMethods(){}
        public static function faind(int $id){
            if(!intval($id)){
                $dataError=language::trnaslate('intigerError');
                erorrDetect::thrownew('intigerError',$dataError);
            }else{
                self::$id=intval($id);
                $query=self::where(intval($id),self::$idName,'=');
                if(!$query){
                    $dataError=language::trnaslate('dataError',false,'{field}','id');
                    $dataError=language::trnaslate($dataError,false,'{where}',$id,false);
                    erorrDetect::thrownew('dataError',$dataError);
                }
            }
            return $query[0];
        }
        public static function showAll($limit=false){
            $sql= new sql();
            if(!$limit) {
                $array=$sql->SqlloopAll('SELECT * FROM '.self::$table );
            }else{
                $array=$sql->SqlloopAll('SELECT * FROM '.self::$table .' LIMIT '.intval($limit).' ');
            }
            return $array;
        }
        public static function delete(int $id){
            self::$id=intval($id);
            $sql= new sql();
            $query='DELETE FROM '.self::$table .' WHERE '.self::$idName.'  = '.self::$id;
            return $sql->MsQuery($query);
        }
        public static function updata(int $id,$values){

            self::$id=intval($id);
            $sql= new sql();
            $sqlQuery='UPDATE '.self::$table.' SET';
            $sqlQuery.=self::SetUpdate($values);
            $sqlQuery.=' WHERE '.self::$idName.' ='.self::$id;
            return $sql->MsQuery($sqlQuery);
        }
        public function unique($unique=false,$value){
            if($unique) {
                self::$unique = $unique;
            }
            $query=self::where($value,self::$unique,'=');
            if($query){
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
        private  static function where($where,$field,$operator,$debag=false){
            $sql= new sql();
            $query = 'SELECT * FROM  '.self::$table.' where ' .$sql->escepeString($field). ' ' . $sql->escepeString($operator) . ' "' . $sql->escepeString($where) . '"';
            $equery=$sql->SqlloopAll($query);
            if(count($equery)==0 && $debag){
                $dataError=language::trnaslate('dataError',false,'{where}',$where);
                $dataError=language::trnaslate($dataError,false,'{field}',$field,false);
                erorrDetect::thrownew('dataError',$dataError);
            }
            return  $equery;
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
        private function sqlProtection(){
            $sql= new sql();
            self::$table=$sql->escepeString(self::$table);
        }
    }
?>