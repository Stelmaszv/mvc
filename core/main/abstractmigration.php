<?php
namespace core\main;
abstract class abstractmigration{
    protected abstract function scheme();
    public function run(){
        $this->scheme();
    }
}