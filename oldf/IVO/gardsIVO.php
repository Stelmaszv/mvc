<?php
namespace IVO;
use App\IVO;
class gardsIVO extends  IVO{
    public static $registry = [];
    public static $gardItems = [];
    public static function newGard($name,$view,$resolve){
        array_push(self::$registry,array(
            $name => $resolve,
            $view => $view,
        ));
        array_push(self::$gardItems,array(
            'view' => $view,
            'gard' => $name,
        ));
    }

    public static function getGard($index,$view){

        $name = static::$registry[$index][self::faindGardName($view)];
        return $name(new self);
    }
    private function faindGardName($view){
        foreach (static::$gardItems as $item){
            if($item['view']==$view){
                return $item['gard'];
            }

        }
        return 'ifLogin';
    }
}