<?php
namespace CoreMain;
interface modelCi{
    static function faind($id=false);
    static function showAll($limit);
    static function delete($id=false);
    static function updata($id=false,$values);
}