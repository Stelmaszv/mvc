<?php
namespace core\main\controller\templete;
use core\main\controller\templete\templete_interface;
class templete_PHP implements templete_interface{
    public function init(string $file,array $arguments){
        require $file;
    }
    public function __toString()
    {
        return '';
    }
}