<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
// CREATE TABLE `test`.`querytest` ( `id` INT NOT NULL AUTO_INCREMENT , `mees` INT NOT NULL , `adress` INT NOT NULL , PRIMARY KEY (`id`), FOREIGN KEY (mees) REFERENCES users(id)) ENGINE = InnoDB
// CREATE TABLE IF NOT EXISTS ge(wqg int(100) NOT NULL ,erg2 int(100) NULL ,erg varchar(100) COLLATE utf8_polish_ci NULL  PRIMARY KEY (`wqb`)
//CREATE TABLE IF NOT EXISTS ge(wqg `int` NOT NULL AUTO_INCREMENT  ,erg2 `int` NULL   ,erg varchar(100) COLLATE utf8_polish_ci NULL , PRIMARY KEY (`wqg`), FOREIGN KEY (erg2) REFERENCES users(id))
namespace core\main;
use core\db\db;
abstract class abstractmigration{
    private $query='';
    private $query_elemnts=[];
    private $query_argumants=[];
    private $is_Table=false;
    private $objects=[];
    private $db;
    function __construct(){
        $this->db=new db(); 
        $this->db=$this->db->get_Engin();
        $this->objects=['table'=>new table,'int'=>new intVal,'varchar'=>new varchar];
    }
    protected abstract function scheme();
    protected function add(string $object,array $arguments){
        if ($this->check_Query() && !$this->is_Table ){
            $this->query.=" (";
            $this->is_Table=True;
        }
        if ($object != 'relation'){
            $this->query=$this->objects[$object]->run($arguments);
        }
        array_push($this->query_elemnts,$this->query);
        array_push($this->query_argumants,$arguments);
    }
    protected function show_Query(){
        return $this->query;
    }
    private function check_Query(){
        if (strpos($this->query, 'TABLE')){
            return true;
        }
    }
    private function bild_Query(){
        $index=0;
        $this->query='';
        foreach($this->query_elemnts as $el){
            $last=count($this->query_elemnts)-1;
            switch($index){
                case 1:
                    $this->query.='(';
                    $this->query.=$el;
                    $this->query.=',';
                break;
                case 0:
                    $this->query.=$el;
                break;
                case $last:
                    $this->query.=$el;
                break;
            }
            if($index < $last-1 && $index!=0 && $index!=1 ){
                $this->query.=$el;
                $this->query.=',';
            }
            $index++;
        }
        $this->add_KEYS();
    }
    private function add_KEYS(){
        $this->query.=$this->faind_Primary_Key();
        $this->query.=$this->faind_FOREIGN_KEYS();
        $this->query.= ')';
    }
    private function faind_FOREIGN_KEYS(){
        foreach($this->query_argumants as $el){
            foreach($el as $item){
                if (is_array($item)){
                    if (isset($item['FK'])){
                        $FOREIGN_KEY_VALUE= $item['FOREIGN_KEY_VALUE'];
                        $FOREIGN_KEY_REFERENCES= $item['FOREIGN_KEY_REFERENCES'];
                        $FOREIGN_KEY_REFERENCES_KEY= $item['FOREIGN_KEY_REFERENCES_KEY'];
                    }
                }
            }
        }
        return ', FOREIGN KEY ('.$FOREIGN_KEY_VALUE.') REFERENCES '.$FOREIGN_KEY_REFERENCES.'('.$FOREIGN_KEY_REFERENCES_KEY.')';
    }
    private function faind_Primary_Key(){
        $name='';
        foreach($this->query_argumants as $el){
            foreach($el as $item){
                if ($item=='PRIMARY KEY'){
                    $name= $el['name'];
                }
            }
        }
        return ', PRIMARY KEY (`'.$name.'`)';
    }
    public function run(){
        $this->scheme();
        $this->bild_Query();
        echo $this->query;
        echo $this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
    }
    // add prenent run in extends 
    public function __call($method, $args) {
        return (new \ReflectionClass($this))->$method();
    }
}
class table{
    function run(array $arguments){
        return "CREATE TABLE IF NOT EXISTS ".$arguments['name'];
    }
}
abstract class abstractvalue{
    protected function setNull(array $null){
        if (!isset($null['NULL'])){
            return 'NULL';
        }
        return $null['NULL'];
    }
    protected function if_AUTO_INCREMENT(array $arguments){
        if (isset($arguments['AUTO_INCREMENT'])){
            return 'AUTO_INCREMENT';
        }
    }
}
class intVal extends abstractvalue{
    function run(array $arguments){
        return "`".$arguments['name']."` int ".$this->setNull($arguments)." ".$this->if_AUTO_INCREMENT($arguments)."  ";
    }
}
class varchar extends abstractvalue{
    function run(array $arguments){
        return "`".$arguments['name']."` varchar(".$arguments['lenght'].") COLLATE ".config['db']['dbCOLLATE']." ".$this->setNull($arguments)." ";
    }
}