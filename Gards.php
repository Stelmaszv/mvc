<?php
use IVO\gardsIVO;
use App\gardControler;
use gard\ifAdmin;
use gard\ifLogin;
$gards=new gardsIVO();
$gards::newGard('ifAdmin','showUsers', function () {
    return ifAdmin::create();
});
$gards::newGard('ifLogin','showSection', function () {
    return ifLogin::create();
});
new gardControler($gards);