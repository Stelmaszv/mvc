<?php
$language=array(
    'settings'=> array('sex'=>'s'), /* settins for sex */
    /* translated words */
    'translate'=>array(
        'welcome' => 'welcome on the may page',
        'like'    => '{Name} like{SEX} your post',
        'TemplateEror' => 'Template file {className} does not exist',
        'ControlerMethodError' => 'Method  {function} in controller {controler} does not exist',
        'ControllerExistError'  => 'Controller {name} does not exist',
        'DBError'=> 'Cannot be connet to data base chceck connetion',
        'ModeltableError'=> 'Undefined table in model {model} or table do doesnt exist',
        'urlLanght'  => 'Missing {Langht}/{required} urls in the controller {controler} ',
        'dataError'  => 'Connot faind data in model prametrs:field={field},where={where}',
        'intigerError'=> 'value in function faind must be integer',
        'noerror'  => 'Not found error ',
        //validation
        'passwordsWrong' =>'Passwords are not the same',
        'tomenyUper' =>'The password has too many upper case characters.',
        'tomenyLower' =>'The password has too many lower case characters.',
        'tomenynumeral'  => 'The password has too many numeral characters.',
        'tomenyspecial'  => 'The password has too many special characters.',
        'passwordshort' =>'password is to short',
        'passwordweeek'=>'Password is to weeek',
        'emptyFile'       =>'File in {name} have not been added',
        'tobigFile'       =>'File in {name} is to big',
        'ext'             =>'File in {name} has a wrong extension',
        'wrongemail'   =>'Field {name} has wrong email',
        'unique'   =>'Field {name} is not unique',
        'tolong'=>'Field {name} is to long',
        'tosmall'=> 'Field {name} is to small',
        'emptyField'=>'Field {name} is empty'
    )
);
define('language',$language);