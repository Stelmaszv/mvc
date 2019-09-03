<?php
namespace App;
abstract  class authInterface{
    abstract  function faindUsertoLogin($data);
    abstract static function ifAuth();
    abstract static function returnAuth();
}