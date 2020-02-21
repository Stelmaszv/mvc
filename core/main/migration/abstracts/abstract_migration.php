<?php
namespace core\main\migration\abstracts;
use core\db\set_db;
use core\helpel\clas\text_in_consol;
use core\main\migration\columns\table;
use core\main\migration\columns\intVal;
use core\main\migration\columns\varchar;
use core\main\migration\relations\one_to_one;
use core\main\migration\relations\one_to_many;
use core\main\migration\relations\many_to_many;
//use core\interfaces\migration_Interface;
abstract class abstract_migration{
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
    use \class_Name, \singleton_Create;
    function __construct()
    {
        $this->db=new set_db(); 
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
        $query=$this->objects['table']->$run(['table'=>$this->table]);
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
            
            $query=$this->objects[$object]->$run($run_Argument);
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
    private function add_FOREIGN_KEYS() : string
    {
        $query='';
        foreach($this->querys['actual'] as $el){
            $query.=$el;
        }
        return $query;
    }
    private function add_KEYS() : void
    {
        $this->query.=$this->faind_Primary_Key();
        $this->if_Isset_FOREIGN_KEYS();
        if($this->FOREIGN_KEY){
            $this->Create_FOREIGN_KEYS();
            $this->query.=$this->add_FOREIGN_KEYS();
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
            $add_to_Query=$this->relations[$item['relation_Type']]->run($item,$this->table);
            $this->update_Query($add_to_Query);
        }
    }
    private function faind_Table() : void
    {
        $loop = $this->db->faind_Table($this->table);
        if($loop){
            if ($this->reset){
                $this->query="DROP TABLE `".$this->table."`";
                $query=$this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
                text_in_consol::consol_log($query);
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
            $query=$this->db->run_Query($el,'Executed query : '.$el,[]);
            text_in_consol::consol_log($query);
        }
    }
    public function run() : void
    {
        $this->scheme();
        $bild='bild_'.$this->query_Type.'_Query';
        $this->$bild();
        if(strlen($this->query)){
            $query=$this->db->run_Query($this->query,'Executed query : '.$this->query,[]);
            text_in_consol::consol_log($query);
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