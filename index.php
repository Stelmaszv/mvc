<?php
include 'setings.php';
include 'include.php';
$view = new mianControler();
$action = new actionPost($_POST);
echo $view->view();
$web= new randomUserData();
?>


