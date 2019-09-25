<?php
use CoreIoC\views;
use CoreMain\mainControler;
use AppControler\home;
use AppControler\test;
use AppControler\error;
views::register('home',function(){
    return home::create();
});
views::register('error',function(){
    return error::create();
});
views::register('test',function(){
    return test::create();
});
$main=new mainControler(views::resolveView());
echo $main->show();



