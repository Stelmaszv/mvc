<?php
include 'setings.php';
require 'vendor/autoload.php';
use App\mianControler;
use App\actionPost;
$view = new mianControler();
$action = new actionPost($_POST);
echo $view->view();
?>


