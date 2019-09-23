<?php
namespace action;
use App\action;
use App\auth;
class logout extends action{
    public function execute(){
        auth::logout();
    }
}