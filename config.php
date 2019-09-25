<?php
session_start();
use Corelanguage\language;

// basic settings //
$config['defultlanguage']='eng';
$config['templete']=true;
$config['debag']=true;

define('config',$config);
/*set Url*/
if(isset($_GET['url'])){
    $url= explode('/',$_GET['url']);
}else{
    $url=false;
}
define('url',$url);

/* get language */
new language;
language::changeLanguage('pl');
// echo language::trnaslate('like','F','{Name}','Dymka'); language schema
