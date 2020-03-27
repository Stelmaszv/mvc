<?php
use core\main\migration\migrationinit;
use app\migrations\{test2,onetoonetest,modelrendertest};
$migration_List=[new onetoonetest,new test2,new modelrendertest];
$migrationinit=new migrationinit($migration_List);
$migrationinit->migrate();

