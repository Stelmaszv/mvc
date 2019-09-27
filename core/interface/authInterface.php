<?php
namespace Coreinterface;
interface authInterface{
    function loginStart();
    static function ifAuth();
    static function returnAuth();
    static function logout();
    function register();
}