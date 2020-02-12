<?php
namespace app\migrations;
use core\main\abstractmigration;
class test extends abstractmigration{
    function scheme(){
        $this->add('table',['name'=>'ge']);
        $this->add('int',['name'=>'wqg','lenght'=>100,'NULL'=>'NOT NULL','AUTO_INCREMENT'=>true,'PRIMARY_KEY'=>true]);
        $this->add('varchar',['name'=>'erg','lenght'=>100]);
    }
}