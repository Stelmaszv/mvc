<?php
    namespace CoreMain;
    use Corelanguage\language;
    use CoreErorr\erorrDetect;
    class DB{
        private $sql;
        private $pdo;
        public function __construct(){
            try{
                $this->pdo = new \PDO('mysql:host='.config['host'].';dbname='.config['dbname'].';port='.config['port'],config['username'],config['password']);
                $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                erorrDetect::thrownew('TemplateEror',language::getWord('DBError'));
                
            }
        }
        public function sqlloopAll($sql,$array=array()){
            $query=$this->pdo->prepare($sql);
            $query->execute($array);
            $array=[];
            while($row = $query->fetch()){
                $array[]=$row;
            }
            return $array;
        }
        public function query($sql,$array=array()){
            $query=$this->pdo->prepare($sql);
            $query->execute($array);
        }
        public function sqlOne($sql,$array=array()){
            return $this->sqlloopAll($sql,$array)[0];
        }
        public function countSql($sql,$array=array()){
            return count($this->sqlloopAll($sql,$array));
        }

    }
?>