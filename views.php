<?php
use App\views;
use App\mianControler;
use controler\home;
use controler\showUsers;
use controler\start;
use controler\login;
use controler\register;
use controler\showSection;
use controler\logout;
views::register('home', function () {
    return new home('./templete/home.htm');
});
views::register('start', function () {
    return new start('./templete/start.htm');
});
views::register('register', function () {
    return new register('./templete/register.htm');
});
views::register('login', function () {
    return new login('./templete/login.htm');
});
views::register('showSection', function () {
   return new showSection('./templete/showSection.htm');
});
views::register('logout', function () {
    return new logout('./templete/showUsers.htm');
});
views::register('showUsers', function () {
    return new showUsers('./templete/showUsers.htm');
});
$view = new mianControler(views::resolve());
echo $view->view();