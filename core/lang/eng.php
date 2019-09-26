<?php
$language=array(
    'settings'=> array('sex'=>'s'), /* settins for sex */
    /* translated words */
    'translate'=>array(
        'welcome' => 'welcome on the may page',
        'like'    => '{Name} like{SEX} your post',
        'TemplateEror' => 'Template file {className} does not exist',
        'ControllerMethodError' => 'Method  {function} in controller {controler} does not exist',
        'ControllerExistError'  => 'Controller {name} does not exist',
        'DBError'=> 'Cannot be connet to data base chceck connetion',
        'ModeltableError'=> 'Undefined table in model {model} or table do doesnt exist',
        'urlLanght'  => 'Missing {Langht}/{required} urls in the controller {controler} ',
        'dataError'  => 'Connot faind data in model prametrs:field={field},where={where}'
    )
);
define('language',$language);