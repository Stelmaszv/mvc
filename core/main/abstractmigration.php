<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
// CREATE TABLE `test`.`querytest` ( `id` INT NOT NULL AUTO_INCREMENT , `mees` INT NOT NULL , `adress` INT NOT NULL , PRIMARY KEY (`id`), FOREIGN KEY (mees) REFERENCES users(id)) ENGINE = InnoDB
// CREATE TABLE IF NOT EXISTS ge(wqg int(100) NOT NULL ,erg2 int(100) NULL ,erg varchar(100) COLLATE utf8_polish_ci NULL  PRIMARY KEY (`wqb`)
//CREATE TABLE IF NOT EXISTS ge(wqg `int` NOT NULL AUTO_INCREMENT  ,erg2 `int` NULL   ,erg varchar(100) COLLATE utf8_polish_ci NULL , PRIMARY KEY (`wqg`), FOREIGN KEY (erg2) REFERENCES users(id))
namespace core\main;
use core\db\db;
use core\interfaces\migration_Interface;
abstract class abstractmigration{
    private $query='';
    private $query_elemnts=[];
    private $query_argumants=[];
    private $is_Table=false;
    private $objects=[];
    private $query_Type;
    public $item=-1;
    public $table;
    public $db;
    function __construct()
    {
        $this->db=new db(); 
        $this->db=$this->db->get_Engin();
        $this->objects=['table'=>new table($this->db),'int'=>new intVal($this->db),'varchar'=>new varchar($this->db)];
    }
    protected abstract function scheme() : void;
    protected function set_Table(string $table) : void
    {
        $this->table=$table;
        $this->faind_Table();
    }
    protected function add(string $object,array $argument) : void
    {
        $run=$this->query_Type;
        array_push($this->query_argumants,$argument);
        if ($object != 'relation'){
            $run_Argument=[
                'argument'=>$argument,
                'object'=>$this,
            ];
            
            $query=$this->objects[$object]->$run($run_Argument);
            array_push($this->query_elemnts,$query);
        }
        $this->item=$this->item+1;
    }
    protected function show_Query() : string
    {
        return $this->query;
    }
    private function check_Query() : bool
    {
        if (strpos($this->query, 'TABLE')){
            return true;
        }
    }
    private function bild_Create_Query() : void
    {
        $this->query='';
        $index=-1;
        foreach($this->query_elemnts as $el){
            $this->query.=$el;
            $last=count($this->query_elemnts)-1;
            if ($index > -1 && $index < $last-1){
                $this->query.=',';
            }
            $index++;
        }
        $this->add_KEYS();
    }
    private function bild_Alter_Query() : void
    {
        $this->query='';
        foreach($this->query_elemnts as $el){
            $this->query.=$el;
        }
    }
    private function add_KEYS() : void
    {
        $this->query.=$this->faind_Primary_Key();
        $this->query.=$this->faind_FOREIGN_KEYS();
        $this->query.= ')';
    }
    private function faind_FOREIGN_KEYS() : string 
    {
        $FOREIGN_KEY_VALUE='';
        $FOREIGN_KEY_REFERENCES='';
        $FOREIGN_KEY_REFERENCES_KEY='';
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
    private function faind_Table() : void
    {
        $loop = $this->db->faind_Table($this->table);
        if($loop){
            $this->query_Type = 'Alter';
        }else{
            $this->query_Type = 'Create';
        }
    }
    private function faind_Primary_Key() : string
    {
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
    public function run() : void
    {
        $this->scheme();
        $bild='bild_'.$this->query_Type.'_Query';
        $this->$bild();
        echo $this->show_Query();
        if(strlen($this->query)){
            echo $this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
        }
    }
    // add prenent run in extends 
    public function __call($method, $args) {
        return (new \ReflectionClass($this))->$method();
    }
}
class table implements migration_Interface{
    function Create(array $fun_argument) : string
    {
        return "CREATE TABLE IF NOT EXISTS ".$fun_argument['object']->table."(";
    }
    function Alter(array $arguments) : string
    {
        return "";
    }
}
abstract class abstract_Value implements migration_Interface{
    protected $column='';
    protected $db;
    protected $change;
    protected $type;
    function __construct(object $db){
        $this->db=$db;
    }
    protected function setNull(array $null) : string
    {
        if (!isset($null['NULL'])){
            return 'NULL';
        }
        return $null['NULL'];
    }
    protected function if_AUTO_INCREMENT(array $arguments) : string
    {
        if (isset($arguments['AUTO_INCREMENT'])){
            return 'AUTO_INCREMENT';
        }
        return '';
    }
    protected function return_Field(array $fun_argument) : array
    {
        return $this->db->return_Colum($fun_argument['object']->table,$fun_argument['argument']['name'],$fun_argument['object']->item);
    }
    protected function if_Available(array $fun_argument) : bool
    {
        return $this->db->faind_Column($fun_argument['object']->table,$fun_argument['argument']['name']);
    }
    protected function Alter_Shema(array $fun_argument) : string
    {
        $query='';
        $name=$this->return_Field($fun_argument);
        if (!$this->if_Available($fun_argument) && $name['Field'] != $fun_argument['argument']['name']){
            if(count($name)){
                $query = " ALTER TABLE `".$fun_argument['object']->table."` CHANGE `".$name['Field']."` `".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->setNull($fun_argument['argument'])."; ";
            }else{
                $query = " ALTER TABLE `".$fun_argument['object']->table."` ADD `".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->setNull($fun_argument['argument'])."; ";
            }
        }
        return $query;
    } 
    function Alter(array $fun_argument) : string
    {
        return $this->Alter_Shema($fun_argument);
    }
    function Create(array $fun_argument): string{
        return "`".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->if_AUTO_INCREMENT($fun_argument['argument'])."   ";
    }
}
class intVal extends abstract_Value{
    protected $type='INT';
}
class varchar extends abstract_Value{
    protected $type = 'VARCHAR';
}