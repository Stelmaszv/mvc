<?php
namespace CoreGard;
use CoreMain\gard;
use CoreMain\auth;
use Corehelpel\urls;
class iflogin extends gard{
    public function check($data=false){
        if(auth::ifAuth()){
            urls::home();
        }
    }
}