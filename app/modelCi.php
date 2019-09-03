<?php
namespace App;
abstract  class modelCi{
    abstract function faind($id,$idFieldName);
    abstract function showAll($limit);
}