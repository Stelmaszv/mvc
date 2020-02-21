<?php
namespace core\main\migration\columns;
use core\interfaces\migration_Interface;
class table implements migration_Interface{
    function Create(array $fun_argument) : string
    {
        return "CREATE TABLE IF NOT EXISTS ".$fun_argument['table']."(";
    }
    function Alter(array $arguments) : string
    {
        return "";
    }
}