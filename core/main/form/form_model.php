<?php
namespace core\main\form;
use core\main\model\abstract_model; 
use core\main\model\search_model;
use core\main\form\fields\{varchar,many_to_many};
use core\exception\catch_exception;
class form_model{
    use \array_manipulation;
    private $model;
    private $id;
    private $fields;
    private $inputs_strings;
    private $form_head;
    private $form_close;
    private $method;
    private $submit;
    function __construct(abstract_model $abstract_model,int $id=0,string $form,string $method='POST'){
        $this->model=new search_model($abstract_model);
        $this->set_method($method);
        $this->form_head='<form method="'.$this->method.'">';
        $this->submit='<input type="submit" name='.$form.'>';
        $this->form_close='</form>';
        $this->id=$id;
        $this->fields_inputs=['varchar'=>new varchar,'many_to_many' => new many_to_many];
        $this->fields=$this->model->return_fields_list();
    }
    private function set_method(string $method) : void
    {
        if($method == 'POST' || $method =='GET'){
            $this->method=$method;
        }else{
            catch_exception::throw_New('Method must be GET or POST" ',true);
        }
    }
    private function return_form() : string
    {
        $this->inputs_strings=$this->form_head;
        foreach($this->fields as $input){
            $item=$this->fields_inputs[$this->if_isset_in_array($this->fields_inputs,$input['type']->class_Name())];
            $this->inputs_strings.=$item->get_input($input);
        }
        $this->inputs_strings.=$this->submit;
        $this->inputs_strings.=$this->form_close;
        return $this->inputs_strings;
    }
    function __toString(){
        return $this->return_form();
    }


}