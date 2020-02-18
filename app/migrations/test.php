<?php
namespace app\migrations;
use core\main\abstractmigration;
class test extends abstractmigration{
    function scheme() : void
    {
        $this->set_Table('ge2');
        $this->add('table',['name'=>'ge']);
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('int',['name'=>'relation_key','lenght'=>100]);
        $this->add('varchar',['name'=>'erg','lenght'=>100]);
    }
}