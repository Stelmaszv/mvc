<?php
session_start();
if(isset($_GET['url'])){
    $url= explode('/',$_GET['url']);
}else{
    $url=false;
}

define('url',$url);
