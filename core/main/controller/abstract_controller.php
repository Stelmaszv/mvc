<?php
namespace core\main\controller;
use core\main\controller\abstract_controller;
use core\exception\catch_exception;
abstract class abstract_controller{
    use \class_Name,\singleton_Create;
    private $templete;
    private function __construct(){
        $this->templete=new templete;
        $this->post=new request_post;
    }
    protected function render(string $file,array $attributes){
        if(file_exists($file)){
            return $this->templete->init($file,$attributes);
        }else{
            catch_exception::throw_New('Templete "'.$file.'" not foud ',false);
        }
    }
    protected function onPost(string $post,string $method,array $attributes)
    {
        if($this->post->isset_Post($post)){
            if(!method_exists($this, $method)){
                catch_exception::throw_New('Method "'.$method.'" not foud in controller "'.$this->class_Name().'" ',true);
            }
            return $this->$method($attributes,$this->post->return_posts_request());
        }
    }
    protected abstract function main(array $request,object $db);
}