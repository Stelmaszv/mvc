<?php
namespace App;
abstract class action{
    use \singletonCreate;
    private function __construct(){}
    abstract  function execute();
}