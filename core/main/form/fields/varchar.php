<?php
namespace core\main\form\fields;
class varchar{
    function get_input(array $input){
        $name=$input['colum']; 
        return '<div><input name="'.$name.'" type="text"></div>';
    }
}