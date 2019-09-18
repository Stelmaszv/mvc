<?php
use IVO\actions;
use App\actionControler;
use action\delete;
use action\logout;
actions::register('delete', function () {
    return delete::create();
});
actions::register('logout', function () {
    return logout::create();
});
if(isset($_GET['action'])) {
    $actionControler = new actionControler(actions::resolve($_GET['action']));
    $actionControler->execute();
}