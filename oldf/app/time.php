<?php
namespace App;
class Time{
    public function __construct(){
        $this->data = new \DateTime('NOW');
    }
    function addTodata($add){
        $this->data->modify($add);
    }
    function returndata(){
        return $this->data->format('G:i:s');
    }

}