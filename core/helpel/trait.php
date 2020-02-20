<?php
trait array_manipulation{
    public function faind_key_in_array(array $array,string $key) : string
    {
        if(isset($array[$key])){
            return $key;
        }
        exit('Key '.$key.' has not faind in array '.$this->return_array_as_string($array));
    }
    public function return_array_as_string(array $array) : string {
        $items='';
        foreach($array as $el => $key){
            $items.=' '.$el.' ';
        }
        return $items;
    }
    public function update_array(array $getArray,array $add_to_array){
        foreach($getArray as $query){
            array_push($add_to_array,$query);
        }
    }
}
trait trait_Db{
    public function show_Columns(string $table) : array
    {
        return  $this->get_Query_Loop('SHOW COLUMNS FROM ' . $table);
     }
     public function show_Tables() : array
     {
        return  $this->get_Query_Loop('SHOW TABLES');
     }
     public function faind_Table(string $table) : bool
     {
        $this->table_List=$this->show_Tables();
        $faind=false;
        $colum='Tables_in_'.config['db']['dbname'];
        foreach ($this->table_List as $el){
            if($el[$colum]===$table){
                $faind = true;
            }
        }
        return $faind;
    }
    public function faind_Column(string $table,string $colum) : bool
    {
        $this->table_Column=$this->show_Columns($table);
        $faind=false;
        foreach ($this->table_Column as $el){
            if($el['Field']===$colum){
                $faind = true;
            }
        }
        return $faind;
    }  
    public function return_Colum(string $table,string $colum,int $item) : array
    {
        $this->table_Column=$this->show_Columns($table);
        $faind=[];
        $index=0;
        foreach ($this->table_Column as $el){
            if($index==$item){
                $faind=$el;
            }
            $index=$index+1;
        }
        return $faind;
    }
}
trait singleton_Create {
    static function create($data=false) {
        static $instances = array();
        $calledClass = get_called_class();
        if (!isset($instances[$calledClass])) {        
            $instances[$calledClass] = new $calledClass($data);
        }
        return $instances[$calledClass];
    }
}
/*
trait faindTableT {
    function faindTable($table){
        $sql= new DB();
        $tableList=$sql->SqlloopAll('SHOW tables');
        foreach ($tableList as $el){
            if($el['Tables_in_test']==$table){
                return true;
            }
        }
        return false;
    }
}
*/
trait class_Name{
    function class_Name(){
        return (new \ReflectionClass($this))->getShortName();
    }
}