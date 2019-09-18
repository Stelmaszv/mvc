<?php
namespace action;
use App\action;
use helpels\urls;
use model\users;

class delete extends action{
    public function execute(){
        $users=new users();
        $users::delete($_GET['id']);
        urls::refresh();
   }
}