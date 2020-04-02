<?php
namespace core\main\form\fields;
use core\main\model\abstract_model; 
use core\db\set_db;
class many_to_many{
    function get_input(array $input){
        $this->db=new set_db(); 
        $this->db=$this->db->get_Engin();
        static $instances = array();
        $obj=$input['type']->get_Table();  
        $model_obj = "\\app\\models\\".$obj;
        $model = new $model_obj($this->db);
        $array=$model->get_All();
        $form=$input['type']->get_inForm(); 
        $input='<div><select name="'.$input['colum'].'[]" multiple>';
        foreach($array as $item){
            $input.='<option value="'.$item['id'].'">'.$item[$form].'</option>';
        }
        $input.='</select></div>';
        return $input;
    }
}