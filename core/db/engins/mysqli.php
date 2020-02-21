<?php
namespace core\db\engins;
use core\db\interfaces\db_interface;
class mysqli implements db_interface{
    use \trait_Db;
    function __construct($sql=false){
        try {
            $this->com = new \MySQLi(config['db']['host'],config['db']['username'],config['db']['password'],config['db']['dbname']);
            $this->sql = $sql;
        }catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
    function get_Query_Loop(string $sql,$array=[]) : array{
        $ret=array();
		$result = mysqli_query($this->com,$sql);
		while($text = mysqli_fetch_assoc($result)){
		     $ret[]=$text;
		}
        return $ret;
    }
    function run_Query(string $sql,string $mes,$array=[]) : string{
        $query=mysqli_query($this->com, $sql);
        if($query){
            return $mes;
        }else{
            return 'error';
        }
    } 
    private function PrepearQuery($sql=false){
        $queray='';
        if(!$sql){
            $queray=$this->sql;
        }else{
            $queray=$sql;
        }
        return $queray;
   }
}