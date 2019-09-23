<?php
use App\includeFiles;
$styles=array(
);
$scripts[0]=array(
    'name' => 'https://code.jquery.com/jquery-3.4.1.min.js'
);
$passwordOptions = [
    'cost' => 12,
];
$auth=[
    'table'      =>'users',
    'loginField' =>'login',
    'password'   => 'password'
];
$files=new includeFiles();



//array_push($scripts,$files->addElemnts('assets/js/'));


define('gardItems',array());
define('auth',$auth);
define('seeder',true);
define('passwordOptions',$passwordOptions);
define('homeLocation','index.php');
define('loginLocation','index.php?view=login&&title=login');
define('stylesUrls',$styles);
define('stylesAssets',$files->addElemnts('assets/css/'));
define('styles',$files->addElemnts('public/css/'));
define('scriptsUrls',$scripts);
define('scriptsAssets',$files->addElemnts('assets/js/'));
define('scripts',$files->addElemnts('public/js/'));
define("servername", "localhost");
define("username", "root");
define("password", "");
define("dbname", "test");



?>

