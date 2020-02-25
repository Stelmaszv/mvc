<?php 
namespace core\helpel\validator\ruls;
class string_val{
    function valid($url) : string
    {
        if(!is_string($url)){
            $url=$url*1;
        }
        return $url;
    }
}