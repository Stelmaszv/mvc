<?php
namespace App;
abstract  class modelCi{
    abstract static function faind($id=false);
    abstract static function showAll($limit);
    abstract static function delete($id=false);
    abstract static function updata($id=false,$values);
}