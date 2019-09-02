<?php
$styles[0]=array(
    'name' => 'public/css/mian.css'
);
$scripts[0]=array(
    'name' => 'public/js/main.js'
);
$gards[0]=array(
    'route'=>'login',
    'level'=>'nosession'
);
$gards[1]=array(
    'route'=>'register',
    'level'=>'nosession'
);
$gards[2]=array(
    'route'=>'showSection',
    'level'=>'session'
);
$gards[3]=array(
    'route'=>'showUsers',
    'level'=>'admin'
);
$passwordOptions = [
    'cost' => 12,
];
define('passwordOptions',$passwordOptions);
define('homeLocation','index.php');
define('loginLocation','index.php?view=login&&title=login');
define('styles',$styles);
define('scripts',$scripts);
define('gards',$gards);
define("servername", "localhost");
define("username", "root");
define("password", "");
define("dbname", "test");
?>

