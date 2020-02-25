<?php
namespace core\main\router;
use core\main\controller\abstract_controller;
class router_controller{
    private static $route_list=[];
    public static function add(string $url,string $name,abstract_controller $controler,string $medhod=''){
        route_validator::route_valid($url,$name,$controler,$medhod);
        static::$route_list[$name]=[ 
            'url'       => explode('/',$url),
            'name'      =>$name,
            'conroler'  =>$controler,
            'medhod'    =>$medhod 
        ];
    }
    public static function  return_Route(){
        return static::$route_list;
    }
}