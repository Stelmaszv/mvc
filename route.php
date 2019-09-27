<?php
use CoreIoC\views;
use CoreMain\mainControler;
use AppControler\home;
use AppControler\test;
use AppControler\error;
use AppControler\showUsers;
use AppControler\edituser;
use AppControler\deleteuser;
use AppControler\showuser;
use AppControler\register;
use AppControler\login;
use CoreGard\iflogin;
use CoreGard\ifauthlevel;
views::register('login',function(){
    return login::create(iflogin::create());
});
views::register('register',function(){
    return register::create(iflogin::create());
});
views::register('showuser',function(){
    return showuser::create();
});
views::register('deleteuser',function(){
    return deleteuser::create();
});
views::register('edituser',function(){
    return edituser::create();
});
views::register('home',function(){
    return home::create();
});
views::register('error',function(){
    return error::create();
});
views::register('showUsers',function(){
    return showUsers::create(ifauthlevel::create('admin'));
});
views::register('test',function(){
    return test::create();
});
$main=new mainControler(views::resolveView());
echo $main->show();



