<?php
namespace Corehelpel;
class urls{
    static private $url;
    private function returnurl(){
        $count=count(url);
        $count=$count-1;
        $urladd='';
        for($x=0;$x<=$count;$x++){
            $urladd.=url[$x];
            if($x!=$count){
                $urladd.='/';
            }
        }  
        return  $urladd;
    }
    function addToIssetUrl($data){
        header('Location: '.$data);
       
    }
    static function refresh(){
    
        $urladd=self::returnurl();
        $url=config['projectUrl'].$urladd;
        header('Location: '.$url);
    }
    static function home(){
        header('Location: '.config['projectUrl'].config['home']);
    }
    static function setLocation($url){
        header('Location:'.config['projectUrl'].$url);
    }
}