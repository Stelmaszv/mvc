<?php
namespace Corehelpel;
class urls{
    static private $url;
    public function addToIssetUrl(string $data){
        header('Location: '.$data);
    }
    public static function refresh(){
        $urladd=self::returnurl();
        $url=config['projectUrl'].$urladd;
        header('Location: '.$url);
    }
    public static function home(){
        header('Location: '.config['projectUrl'].config['home']);
    }
    public static function error($error){
        $url=config['projectUrl'].'error/main'.$error;
        header('Location: '.$url);
        die();
    }
    public static function setLocation($url){
        header('Location:'.config['projectUrl'].$url);
    }
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
}