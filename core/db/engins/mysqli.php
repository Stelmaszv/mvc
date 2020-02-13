<?php
namespace core\db\engins;
use core\interfaces\dbInterface;
class mysqli implements dbInterface{
    function __construct($sql=false){
        try {
            $this->com = new \MySQLi(config['db']['host'],config['db']['username'],config['db']['password'],config['db']['dbname']);
            $this->sql = $sql;
        }catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
    function get_Query_Loop(string $sql){
        $ret=array();
		$result = mysqli_query($this->com,$this->PrepearQuery($sql));
		while($text = mysqli_fetch_assoc($result)){
		     $ret[]=$text;
		}
	    return $ret;   
    }
    function run_Query(string $sql,string $mes,array $array){
        $query=mysqli_query($this->com, $sql);
        if($query){
            return $mes;
        }
    } 
}