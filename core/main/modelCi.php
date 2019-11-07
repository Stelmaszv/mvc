<?php
namespace CoreMain;
interface modelCi{
    static function faind(int $id);
    static function showAll($limit=false);
    static function delete(int $id);
    static function updata(int $id,$values);
}