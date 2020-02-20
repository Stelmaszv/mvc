<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
// CREATE TABLE `test`.`querytest` ( `id` INT NOT NULL AUTO_INCREMENT , `mees` INT NOT NULL , `adress` INT NOT NULL , PRIMARY KEY (`id`), FOREIGN KEY (mees) REFERENCES users(id)) ENGINE = InnoDB
// CREATE TABLE IF NOT EXISTS ge(wqg int(100) NOT NULL ,erg2 int(100) NULL ,erg varchar(100) COLLATE utf8_polish_ci NULL  PRIMARY KEY (`wqb`)
//CREATE TABLE IF NOT EXISTS ge(wqg `int` NOT NULL AUTO_INCREMENT  ,erg2 `int` NULL   ,erg varchar(100) COLLATE utf8_polish_ci NULL , PRIMARY KEY (`wqg`), FOREIGN KEY (erg2) REFERENCES users(id))
namespace core\main;
use core\db\db;
use core\interfaces\migration_Interface;
abstract class abstractmigration{
    protected $reset=false;
    private $query='';
    private $query_elemnts=[];
    private $query_argumants=[];
    private $querys=['actual'=>[],'added'=>[]];
    private $relations=[];
    private $is_Table=false;
    private $objects=[];
    private $query_Type;
    private $FOREIGN_KEY=false;
    public $item=0;
    public $table;
    public $db;
    use \class_Name,\singleton_Create,\array_manipulation;
    function __construct()
    {
        $this->db=new db(); 
        $this->db=$this->db->get_Engin();
        $this->objects=['table'=>new table($this->db),'int'=>new intVal($this->db),'varchar'=>new varchar($this->db)];
        $this->relations=['one_to_many'=>new one_to_many,'one_to_one' => new one_to_one,'many_to_many' => new many_to_many];
        $this->set_Table($this->class_Name());
    }
    protected abstract function scheme() : void;
    private function set_Table(string $table) : void
    {
        $this->table=$table;
        $this->faind_Table();
        $run=$this->query_Type;
        $query=$this->objects[$this->faind_key_in_array($this->objects,'table')]->$run(['table'=>$this->table]);
        array_push($this->query_elemnts,$query);
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
            
            $query=$this->objects[$this->faind_key_in_array($this->objects,$object)]->$run($run_Argument);
            array_push($this->query_elemnts,$query);
        }
        $this->item=$this->item+1;
    }
    protected function show_Query() : string
    {
        return $this->query;
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
    private function faind_value_in_Migration(string $value):array
    {
        $found=[];
        foreach($this->query_argumants as $el){
            foreach($el as $item){
                if (is_array($item)){
                    if (isset($item[$value])){
                        array_push($found,$item);
                    }
                }
            }
        }
        return $found;
    }
    private function if_Isset_FOREIGN_KEYS() : void
    {
        $item = $this->faind_value_in_Migration('FK');
        if ($item){
            $this->FOREIGN_KEY=true;
        }
    }
    private function add_FOREIGN_KEYS(array $array) : string
    {
        return $this->return_array_as_string($array);
    }
    private function add_KEYS() : void
    {
        $this->query.=$this->faind_Primary_Key();
        $this->if_Isset_FOREIGN_KEYS();
        if($this->FOREIGN_KEY){
            $this->Create_FOREIGN_KEYS();
            $this->query.=$this->add_FOREIGN_KEYS($this->querys['actual']);
        }
        $this->query.= ')';
    }
    private function update_Query(array $atrray) : void
    {
        foreach($atrray['actual'] as $query){
            array_push($this->querys['actual'],$query);
        }
        foreach($atrray['added'] as $query){
            array_push($this->querys['added'],$query);
        }
    }
    private function Create_FOREIGN_KEYS() : void
    {
        $items = $this->faind_value_in_Migration('FK');
        foreach($items as $item){
            $add_to_Query=$this->relations[$this->faind_key_in_array($this->relations,$item['relation_Type'])]->run($item,$this->table);
            $this->update_Query($add_to_Query);
        }
    }
    private function faind_Table() : void
    {
        $loop = $this->db->faind_Table($this->table);
        if($loop){
            if ($this->reset){
                $this->query="DROP TABLE `".$this->table."`";
                echo $this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
                $instance=self::create();
                $instance->run();
            }
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
    private function execute_relations():void
    {
        foreach($this->querys['added'] as $el){
            echo $el;
            $this->db->run_Query($el,'Executed query : '.$el,[]);

        }
    }
    public function run() : void
    {
        $this->scheme();
        $bild='bild_'.$this->query_Type.'_Query';
        $this->$bild();
        echo $this->show_Query();
        if(strlen($this->query)){
            echo $this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
            if($this->FOREIGN_KEY){
                $this->execute_relations();
            }
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
        return "CREATE TABLE IF NOT EXISTS ".$fun_argument['table']."(";
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
    function Create(array $fun_argument): string
    {
        return "`".$fun_argument['argument']['name']."` ".$this->type."(".$fun_argument['argument']['lenght'].") ".$this->setNull($fun_argument['argument'])." ".$this->if_AUTO_INCREMENT($fun_argument['argument'])."   ";
    }
}
class intVal extends abstract_Value{
    protected $type='INT';
}
class varchar extends abstract_Value{
    protected $type = 'VARCHAR';
}
abstract class relation{
    protected $db;
    protected $querys=['actual'=>[],'added'=>[]];
    function FOREIGN_KEY(array $fun_argument): string
    {
        $FOREIGN_KEY_VALUE=$fun_argument['FOREIGN_KEY_VALUE'];
        $FOREIGN_KEY_REFERENCES=$fun_argument['FOREIGN_KEY_REFERENCES'];
        $FOREIGN_KEY_REFERENCES_KEY=$fun_argument['FOREIGN_KEY_REFERENCES_KEY'];
        return ', FOREIGN KEY ('.$FOREIGN_KEY_VALUE.') REFERENCES '.$FOREIGN_KEY_REFERENCES.'('.$FOREIGN_KEY_REFERENCES_KEY.')';
    }
}
class one_to_many extends relation{
    function run(array $fun_argument,string $table): array
    {
        array_push($this->querys['actual'],$this->FOREIGN_KEY($fun_argument));
        return $this->querys;
    }
}
class one_to_one extends relation{
    function run(array $fun_argument,string $table): array
    {
        $this->one_to_one($fun_argument,$table);
        array_push($this->querys['actual'],$this->FOREIGN_KEY($fun_argument));
        return $this->querys;
    }
    private function one_to_one(array $fun_argument,string $table):void
    {
        $field_Name=$table;
        $query="ALTER TABLE `".$fun_argument['FOREIGN_KEY_REFERENCES']."` ADD `".$field_Name."` INT NOT NULL;";
        $query2="ALTER TABLE `".$fun_argument['FOREIGN_KEY_REFERENCES']."` ADD FOREIGN KEY (".$field_Name.") REFERENCES `".$table."`(".$fun_argument['FOREIGN_KEY_VALUE'].");";
        array_push($this->querys['added'],$query);
        array_push($this->querys['added'],$query2);
    }
}

class many_to_many extends relation{
    function run(array $fun_argument,string $table): array
    {
        $this->many_to_many($fun_argument,$table);
        return $this->querys;
    }
    private function many_to_many(array $fun_argument,string $table):void
    {
        $relation_name="relaton".$table."".$fun_argument['FOREIGN_KEY_REFERENCES'];
        $relation_one_name="relaton".$table;
        $relation_Two_name="relaton".$fun_argument['FOREIGN_KEY_REFERENCES'];
        $query="CREATE TABLE ".$relation_name."(";
        $query.="id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
        $query.=")";
        array_push($this->querys['added'],$query);
        $query="ALTER TABLE `".$relation_name."` ADD `".$relation_one_name."` INT NULL;";
        $query2="ALTER TABLE `".$relation_name."` ADD `".$relation_Two_name."` INT NULL;";
        array_push($this->querys['added'],$query);
        array_push($this->querys['added'],$query2);
        $query3="ALTER TABLE `".$relation_name."` ADD FOREIGN KEY (".$relation_one_name.") REFERENCES `".$table."`(id);";
        $query4="ALTER TABLE `".$relation_name."` ADD FOREIGN KEY (".$relation_Two_name.") REFERENCES `".$fun_argument['FOREIGN_KEY_REFERENCES']."`(id);";
        array_push($this->querys['added'],$query3);
        array_push($this->querys['added'],$query4);
    }
}
