<?php
use core\main\migration\migrationinit;
use app\migrations\test2;
use app\migrations\onetoonetest;
$migration_List=[new onetoonetest,new test2];
$migrationinit=new migrationinit($migration_List);
$migrationinit->migrate();

