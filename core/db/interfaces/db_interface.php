<?php
namespace core\db\interfaces;
interface db_interface{
    function get_Query_Loop(string $sql,$array=[]) : array;
    function run_Query(string $sql,string $mes,$array=[]) : string;
}