<?php
namespace app\migrations;
use core\main\migration\abstracts\abstract_migration;
class modelrendertest extends abstract_migration{
    function scheme() : void
    {
        $this->add('int',['name'=>'id','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('int',['name'=>'relation_key','lenght'=>100,'NULL'=>'NOT NULL','type'=>'intval']);
        $this->add('relation',[
            'type'=>'many_to_many',
            'name'=>'relation',
            'lenght'=>100,
            'relation'=>[
                'relation_Type'                =>  'many_to_many',
                'FK'                           =>  true,
                'FOREIGN_KEY_VALUE'            =>  'relation_key',
                'FOREIGN_KEY_REFERENCES'       =>  'onetoonetest',
                'FOREIGN_KEY_REFERENCES_KEY'   =>  'id' 
            ]
        ]);
        $this->add('varchar',['name'=>'erg','lenght'=>100,'type'=>'varchar']);
    }
}