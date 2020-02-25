<?php
namespace core\main\router;
use core\helpel\validator\ruls\{int_val,string_val};
use core\main\controller\abstract_controller;
use core\exception\catch_exception;

class route_validator{
    private static $Items=[];
    public static function route_valid(string $url,string $name,abstract_controller $abstract_controller,string $method,$list_of_contollers): void
    {
        self::uniq_Name($name,$list_of_contollers);
        self::method_Exist($method,$abstract_controller);
    }
    public static function url_valid(array $urls,array $routs ) : array
    {
        $validator=['int'=>new int_val, 'string'=>new string_val];
        $index=0;
        foreach($routs as $rout){
            self::pregmatch('int',$rout,$index);
            self::pregmatch('string',$rout,$index);
            $index=$index+1;
        }
        $index_In_Urls=0;
        foreach($urls as $url){
            foreach (self::$Items as $item ){
                if($item['index'] == $index_In_Urls){
                    $obj  = $validator[$item['type']];
                    $urls[$item['index']] = $obj->valid($url);
                }
            }
            $index_In_Urls=$index_In_Urls+1;
        }
        return $urls;
    }
    private static function pregmatch(string $parten,string $value,int $index) : void
    {
        if(preg_match('/{{'.$parten.':[a-z]*}}$/',$value)){
            array_push(self::$Items,[
                'type' => $parten,
                'index'=> $index
            ]);
        }
    }
    private static function uniq_Name(string $name,array $list_of_contollers) : void
    {
        $foud=false;
        foreach($list_of_contollers as $controller){
            if($controller['name']==$name){
                $foud=true;
                catch_exception::throw_New('controller with name '.$name.' arlerdy exixt ',true);
            }
        }
    }
    private static function method_Exist(string $method,abstract_controller $abstract_controller) : void
    {
        if(!method_exists($abstract_controller, $method) && !empty($method)){
            catch_exception::throw_New('Method "'.$method.'" not foud in controller "'.$abstract_controller->class_Name().'" ',true);
        }
    }
}