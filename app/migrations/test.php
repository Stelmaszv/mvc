<?php
namespace app\migrations;
use core\main\abstractmigration;
class test extends abstractmigration{
    function scheme(){
        $this->add('table',['name'=>'ge']);
        $this->add('int',['name'=>'wqg','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PK'=>'PRIMARY_KEY']);
        $this->add('int',['name'=>'erg2','lenght'=>100]);
        $this->add('relation',['name'=>'relation','lenght'=>100,'FK'=>'FOREIGN KEY', 'REFERENCES - Users','RID'=>'id']);
        $this->add('varchar',['name'=>'erg','lenght'=>100]);
    }
}