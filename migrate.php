<?php
//use AppMigration\test;
//new test();
use core\main\migrationinit;
use app\migrations\test2;
$migration_List=[new test2];
$migrationinit=new migrationinit($migration_List);
$migrationinit->migrate();

