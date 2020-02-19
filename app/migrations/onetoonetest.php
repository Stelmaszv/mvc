<?php
namespace app\migrations;
use core\main\abstractmigration;
class onetoonetest extends abstractmigration{
    function scheme() : void
    {
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('varchar',['name'=>'text','lenght'=>100]);
    }
}