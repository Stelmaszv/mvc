<?php
namespace core\main\controller\templete;
use core\main\controller\templete\templete_interface;
class API implements templete_interface{
    private $arry=[];
    public function init(string $file,array $arguments){
        $this->array=$arguments;
    }
    public function __toString()
    {
        return $this->respanse();
    }
    private function respanse(){
        return json_encode($this->array);
    }

}