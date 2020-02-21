<?php
use core\main\migration\migrationinit;
use app\migrations\test2;
use app\migrations\onetoonetest;
$migration_List=[new test2, new onetoonetest];
$migrationinit=new migrationinit($migration_List);
$migrationinit->migrate();

