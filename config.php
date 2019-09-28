<?php
session_start();
use Corelanguage\language;

// basic settings //
$config['defultlanguage']='eng';
$config['debag']=true;
$config['projectname']='mvc';
$config['projectUrl']='http://localhost/mvc/';
$config['defultController']=array(
    'templete'=>true,
    'requiredUrl'=>0,
    'title'=>$config['projectname'],
    'templeteshema'  =>false
);
$config['homeControler']='home';
// data base settings
$config['host']='localhost';
$config['username']='root';
$config['password']='';
$config['dbname']='test';
$config['port']='3306';
// auth 
$passwordOptions = [
    'cost' => 12,
];
$auth=[
    'table'              =>'users',
    'loginField'         =>'login',
    'password'           => 'password',
    'passwordOptions'    => $passwordOptions
];
$config['auth']=$auth;

define('config',$config);
/*set Url*/
if(isset($_GET['url'])){
    $url= explode('/',$_GET['url']);
}else{
    $url=false;
}
define('controller',$url[0]);
define('method',$url[1]);
define('url',$url);

/* get language */
new language;
language::changeLanguage('eng');
// echo language::trnaslate('like','F','{Name}','Dymka'); language schema
