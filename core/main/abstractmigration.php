<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
namespace core\main;
abstract class abstractmigration{
    private $query;
    private $query_elemnts=[];
    private $is_Table=false;
    private $objects=[];
    function __construct(){ 
        $this->objects=['table'=>new table,'int'=>new intVal,'varchar'=>new varchar];
    }
    protected abstract function scheme();
    protected function add(string $object,array $arguments){
        if ($this->check_Query() && !$this->is_Table ){
            $this->query.=" (";
            $this->is_Table=True;
        }
        $this->query=$this->objects[$object]->run($arguments);
        array_push($this->query_elemnts,$this->query);
    }
    protected function show_Query(){
        return $this->query;
    }
    private function check_Query(){
        if (strpos($this->query, 'TABLE')){
            return true;
        }
    }
    private function final_query(){
        $index=0;
        $this->query='';
        foreach($this->query_elemnts as $el){
            $last=count($this->query_elemnts)-1;
            switch($index){
                case 1:
                    $this->query.='(';
                    $this->query.=$el;
                break;
                case 0:
                    $this->query.=$el;
                break;
                case $last:
                    $this->query.=$el;
                    $this->query.=')';
                break;
            }
            if($index < count($this->query_elemnts)-1 && $index>0){
                $this->query.=',';
            }
            $index++;
        }
        echo $this->show_Query();
    }
    public function run(){
        $this->scheme();
        $this->final_query();
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
    function if_PRIMARY_KEY(array $arguments){
        if (isset($arguments['PRIMARY_KEY'])){
            return "PRIMARY KEY (`".$arguments['name']."`)";
        }
    }
}
class intVal extends abstractvalue{
    function run(array $arguments){
        return "".$arguments['name']." int(".$arguments['lenght'].") ".$this->setNull($arguments)." ".$this->if_AUTO_INCREMENT($arguments).",".$this->if_PRIMARY_KEY($arguments)."";
    }
}
class varchar extends abstractvalue{
    function run(array $arguments){
        return "".$arguments['name']." varchar(".$arguments['lenght'].") COLLATE ".config['db']['dbCOLLATE']." ".$this->setNull($arguments)."";
    }
}