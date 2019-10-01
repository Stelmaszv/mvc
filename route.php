<?php
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
router::route('test',function(){
    return test::create();
});
router::route('showUsers',function(){
    return showUsers::create(ifauthlevel::create('admin'));
});
$show=new mainControler(router::createview());
echo $show->show();