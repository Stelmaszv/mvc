<?php
use gard\ifAdmin;
use gard\ifLogin;
use IVO\gardsIVO;
use App\gardControler;

$gards=new gardsIVO();
$gards::newGard('ifAdmin','showUsers', function () {
    return ifAdmin::create();
});
$gards::newGard('ifLogin','showSection', function () {
    return ifLogin::create();
});
new gardControler($gards);
