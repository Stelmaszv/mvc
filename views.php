<?php
use IVO\views;
use App\mianControler;
use controler\home;
use controler\showUsers;
use controler\login;
use controler\register;
use controler\showSection;
use controler\showUser;
use controler\editUser;
use controler\socetio;
views::register('home', function () {
    return home::create();
});
views::register('socetio', function () {
    return socetio::create();
});
views::register('showUser', function () {
    return showUser::create();
});
views::register('register', function () {
    return register::create();
});
views::register('login', function () {
    return login::create();
});
views::register('showSection', function () {
    return showSection::create();
});
views::register('showUsers', function () {
    return showUsers::create();
});
views::register('editUser', function () {
    return editUser::create();
});
$view = mianControler::create(views::resolveView());
echo $view->view();


