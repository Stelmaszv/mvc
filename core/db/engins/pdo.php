<?php
namespace core\db\engins;
use core\db\interfaces\db_interface;
class pdo implements db_interface{
    use \trait_Db;
    public function __construct(){
        try{
            $this->pdo = new \PDO('mysql:host='.config['db']['host'].';dbname='.config['db']['dbname'].';port='.config['db']['port'],config['db']['username'],config['db']['password']);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            erorrDetect::thrownew('TemplateEror',language::getWord('DBError'));
            
        }
    }
    function get_Query_Loop(string $sql,$array=[]) : array{
        $query=$this->pdo->prepare($sql);
        $query->execute($array);
        $array=[];
        while($row = $query->fetch()){
            $array[]=$row;
        }
        return $array;  
    }
    function run_Query(string $sql,string $mes,$array=[]): string{
        $query=$this->pdo->prepare($sql);
        $query=$query->execute($array);
        if ($query){
            return $mes;
        }
    } 
}