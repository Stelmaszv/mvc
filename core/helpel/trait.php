<?php
use core\exception\catch_exception;
trait array_manipulation{
    public function if_isset_in_array(array $array, string $key) : string 
    {
        if(isset($array[$key])){
            return $key;
        }else{
            $array_in_string=$this->return_array_in_string($array);
            $message='key '.$key.' not exist in array ('.$array_in_string.')';
            catch_exception::throw_New($message,true);
        }
        return '';
    }
    public function return_array_in_string(array $array) : string
    {
        $array_in_string='';
        foreach($array as $item => $value){
            $array_in_string.=' '.$item.' ';
        }
        return $array_in_string;
    }
    public function add_new_values_to_array(array $add,array $get): array
    {
        foreach($get as $query){
            array_push($add,$query);
        }
        return $add;
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
trait class_Name{
    function class_Name(){
        return (new \ReflectionClass($this))->getShortName();
    }
}