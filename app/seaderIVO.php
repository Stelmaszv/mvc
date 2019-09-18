<?php
namespace App;
use App\IVO;
class seaderIVO extends  IVO{
    public static function resolve($name=false){
        if (!static::registered($name)) {
            throw new \Exception(sprintf('%s is not registerd', $name));
        }
        $name = static::$registry[$name];
        return $name(new self);
    }
}