<?php
session_start();
use Corelanguage\language;
// basic settings //
$config['defultlanguage']='eng';
$config['debag']=true;
$config['projectname']='mvc';
$config['projectUrl']='http://localhost/mvc/';
$js=array(
    'custume'            =>false,
    'nourls'             =>false,            
    'noassets'           =>false,
    'nopublic'           =>false,
    'url'                =>includeMedia(array('https://code.jquery.com/jquery-3.3.1.slim.min.js','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')),
    'assets'              =>includeMedia('assets/js'),
    'public'              =>includeMedia('public/js')
);
$css=array(
    'custume'            =>false,
    'nourls'             =>false,            
    'noassets'           =>false,
    'nopublic'           =>false,
    'url'                =>includeMedia(array('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')),
    'assets'             =>includeMedia('assets/css'),
    'public'             =>includeMedia('public/css')
);
$config['defultController']=array(
    'templete'           =>true,
    'requiredUrl'        =>0,
    'title'              =>$config['projectname'],
    'templeteshema'      =>false,
    'nojs'               =>false,
    'js'                 =>$js,
    'nocss'              =>false,
    'css'                =>$css
);
$config['homeControler']='home';
// data base settings
$config['db']=array(
    'host'               =>'localhost',
    'username'           =>'root',
    'title'              =>$config['projectname'],
    'dbname'             =>'test',
    'port'               =>3306,
    'dbCOLLATE'          =>'utf8_polish_ci',
    'dbengin'            =>'mysqli',
    'password'           =>''
);
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
if(isset($url[1])){
    define('method',$url[1]);
}
define('url',$url);

/* get language */
new language;
language::changeLanguage('eng');
