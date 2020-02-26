<?php
namespace core\main\controller;
class request_post{
    public function isset_Post($value) :bool
    {
        if(isset($_POST[$value])){
            return true;
        }
    }
    public function return_posts_request() :array
    {
        return $_POST;
    }
}