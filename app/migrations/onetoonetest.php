<?php
namespace app\migrations;
use core\main\migration\abstracts\abstract_migration;
class onetoonetest extends abstract_migration{
    protected $reset=true;
    function scheme() : void
    {
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('varchar',['name'=>'text','lenght'=>100,'type'=>'varchar']);
    }
}