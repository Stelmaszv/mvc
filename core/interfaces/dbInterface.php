<?php
namespace core\interfaces;
interface dbInterface{
    function get_Query_Loop(string $sql);
    function run_Query(string $sql,string $mes,array $array);
}