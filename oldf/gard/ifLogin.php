<?php
namespace gard;
use App\auth;
use App\gard;
use helpels\urls;
class ifLogin extends gard{
    public function check(){
        if(!auth::ifAuth()){
            $url=new urls();
            $url->addToIssetUrl('?view=login&&title=login');
            $url::redirect();
            return true;
        }
        return false;
    }
}