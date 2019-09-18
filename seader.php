<?php
use seeds\addUser;
use App\seaderIVO;
use App\seaderControler;
$seader=new seaderIVO();
$seader::register('addUser', function () {
    return new addUser(100);
});
$seed=new seaderControler($seader::resolve('addUser'));
$seed->execute();