<?php
include 'setings.php';
require 'vendor/autoload.php';
require  'views.php';
use App\actionPost;
$action = new actionPost($_POST);
?>
