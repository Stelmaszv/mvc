<?php
namespace IVO;
use App\IVO;
class views extends IVO{
    public static function resolveView($name=false){
        if(isset($_GET['view']) && count($_GET)>0 && isset($_GET['title'])) {
            return self::resolve($_GET['view']);
        }else{
            return self::resolve('home');
        }
    }
}



