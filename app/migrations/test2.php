<?php
namespace app\migrations;
use core\main\migration\abstracts\abstract_migration;
use core\db\db;
class test2 extends abstract_migration{
    function scheme() : void
    {
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('int',['name'=>'relation_key','lenght'=>100,'NULL'=>'NOT NULL']);
        $this->add('relation',['name'=>'relation','lenght'=>100,
        'relation'=>['relation_Type'=>'one_to_one',
        'FK'=>true,'FOREIGN_KEY_VALUE' => 'relation_key',
        'FOREIGN_KEY_REFERENCES'=> 'onetoonetest',
        'FOREIGN_KEY_REFERENCES_KEY'=> 'id' ]]);
        $this->add('varchar',['name'=>'erg','lenght'=>100]);
    }
}