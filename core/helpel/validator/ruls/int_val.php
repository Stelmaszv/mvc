<?php 
namespace core\helpel\validator\ruls;
class int_val{
    function valid($url) : int
    {
        if(!is_int($url)){
            $url=$url*1;
        }
        return $url;
    }
}