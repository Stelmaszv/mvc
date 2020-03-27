<?php
namespace core\main\model;
use core\main\migration\abstracts\abstract_migration;
use core\main\migration\migration_search;
use core\main\model\abstract_model;
class model_render{
    use \array_manipulation;
    private $file;
    private $table;
    private $migration;
    CONST heder='<?php 
    namespace app\models; 
    use core\main\model\abstract_model;';
    public function __construct(abstract_migration $migration){
        $this->migration=new migration_search($migration);
        $this->table=$migration->table;
        $this->create_file();
        $this->write_file();
    }
    private function create_file() : void
    {
        $catalog='app/models/';
        $filename= $catalog.''.$this->table.'.php';
        $this->file = fopen($filename, "w");
    }
    private function write_file() : void
    {
        fwrite($this->file, $this->get_data_from_migration());
    }
    private function get_data_from_migration() : string
    {
        $filecontent='';
        $filecontent.=SELF::heder;
        $filecontent.=$this->get_relation();
        $filecontent.=$this->class_generate();
        return $filecontent;
    }
    private function get_relation() :string
    {
        $relation_inports='';
        $inport_models=[];
        $relations=$this->migration->faind_fields_typs('relation');
        foreach($relations  as $relation){
            array_push($inport_models,$relation['FOREIGN_KEY_REFERENCES']);
        }
        foreach($inport_models  as $model){
            $relation_inports.='
            use app\models\ '.$model.';';
        }
        return $relation_inports;
    }
    private function if_relation(array $field){
        return 'true';
    }
    private function convert_type(array $field){
        \vd($field);
    }
    private function add_fields() : string
    {
        $fields=[];
        $fields=$this->migration->return_fields_list();
        foreach($fields as $field){
            if( $field['name'] !='id'){
                array_push($fields,[
                    'colum'    =>$field['name'],
                    'type'     =>$field['type'],
                    'relation' =>$this->if_relation($field)
                ]);
            }
        }
        $adds='';
        foreach($fields as $add){
            $adds.='
            $this->add([
                "colum"    => '.$add['colum'].',
                "type"     =>$this->'.$add['type'].'(),
                "relation" =>'.$add['relation'].',
            ])
            ';
        }
        return $adds;
    }
    private function class_generate() :string
    {
        $class = '
        class '.$this->table.' extends abstract_model { ';
        $class.='
        function validate() : void ';
        $class.='
        {';
        $class.=$this->add_fields();
        $class.='
        }';
        $class.= '
        }';
        return $class;
    }
}