<?php
//use AppMigration\test;
//new test();
use core\main\migrationinit;
use app\migrations\test;
$migration_List=[new test];
$migrationinit=new migrationinit($migration_List);
$migrationinit->migrate();

