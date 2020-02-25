<?php
namespace core\main\router;
use core\exception\catch_exception;
class router_main_controler{
    private $route_list;
    function __construct(array $route_list){
        $this->route_list=$route_list;
    }
    public function run_Controller(){
        $controller=$this->faind_Contrroller();
        if(empty($controller['medhod'])){
            $controller['conroler']->main();
        }else{
            $medhod=$controller['medhod'];
            $controller['conroler']->$medhod();
        }
    }
    private function faind_Contrroller() : array
    {
        $url_count=count(url);
        $controller_faind=[];
        foreach($this->route_list as $list){
            if(count(url) == count($list['url'])){
                $in_controler=['name' => $list['name'],'valid'=>[],'normal'=>[],'varables' =>[]];
                foreach($list['url'] as $rout_incontroler){
                    if(preg_match('/{{int:[a-z]*}}$/',$rout_incontroler) || preg_match('/{{string:[a-z]*}}$/',$rout_incontroler)){
                        array_push($in_controler['varables'],$rout_incontroler);
                    }else{
                        array_push($in_controler['normal'],$rout_incontroler);
                    }
                }
                foreach (url as $in_url){
                    foreach ($in_controler['normal'] as $in_controller){
                        if($in_url == $in_controller){
                            array_push($in_controler['valid'],true);
                        }
                    }
                }
                foreach ($in_controler['varables'] as $in_controller){
                    array_push($in_controler['valid'],true);
                }
                array_push($controller_faind,$in_controler);
            }
        }
        foreach($controller_faind as $url_match){
            $count=0;
            foreach($url_match['valid'] as $valid_list){
                if($valid_list){
                    $count=$count+1;
                    $item=$url_match;
                }
            }
            if($count==$url_count){
                $controller=$item['name'];
            }
        }
        if(isset($controller)){
            $NewController=$this->route_list[$controller];
            $url=route_validator::url_valid(url,$NewController['url']);
            $NewController['url']=$url;
            return $NewController;
        }else{
            catch_exception::throw_New('controller not foud',true);
        }
    }
}