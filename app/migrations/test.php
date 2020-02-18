<?php
namespace app\migrations;
use core\main\abstractmigration;
class test extends abstractmigration{
    function scheme() : void
    {
        $this->set_Table('ge1');
        $this->add('table',['name'=>'ge']);
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('int',['name'=>'relation_key','lenght'=>100,'NULL'=>'NOT NULL']);
        $this->add('relation',['name'=>'relation','lenght'=>100,
        'relation'=>['FK'=>true,'FOREIGN_KEY_VALUE' => 'relation_key','FOREIGN_KEY_REFERENCES'=> 'users','FOREIGN_KEY_REFERENCES_KEY'=> 'id' ]]);
        $this->add('varchar',['name'=>'erg','lenght'=>100]);
    }
}