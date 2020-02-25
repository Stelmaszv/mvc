<?php
use core\main\router\{router_controller,router_main_controler};
use app\controllers\home\home_controller;
router_controller::add('home','home',new home_controller);
router_controller::add('my/home/{{int:name}}','myhome',new home_controller,'test2');
router_controller::add('my/kome/{{int:name}}','myhome2',new home_controller,'test2');
router_controller::add('m4/home','my2home',new home_controller);
$router_main_controler=new router_main_controler(router_controller::return_Route());
$router_main_controler->run_Controller();
/*
use CoreIoC\views;
use CoreMain\mainControler;
use CoreMain\router;
use CoreMain\routerController;
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
router::route('showuser/main/{id}',function(){
    return showuser::create();
});
router::route('showuser/edit/{id}',function(){
    return showuser::create();
});
router::route('showuser/delete/{id}',function(){
    return showuser::create();
});
router::route('home',function(){
    return home::create();
});
router::route('login',function(){
    return login::create(iflogin::create());
});
router::route('register',function(){
    return login::create(iflogin::create());
});
router::route('showUsers',function(){
    return showUsers::create();
});
$show=new mainControler(router::createview());
echo $show->show();
*/