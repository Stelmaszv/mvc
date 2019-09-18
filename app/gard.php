<?php
namespace App;
abstract  class gard{
    use \singletonCreate;
    private function __construct(){}
    abstract  function check();
}