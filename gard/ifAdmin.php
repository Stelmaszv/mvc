<?php
namespace gard;
use App\gard;
use helpels\urls;
use App\auth;
class ifAdmin extends gard{
    public function check(){
        $url=new urls();
        if(auth::ifAuth()){
            if(!auth::ifLevel('admin')){
                $url->addToIssetUrl('?view=login&&title=login');
                $url::redirect();
            }
        }else{
            $url->addToIssetUrl('?view=login&&title=login');
            $url::redirect();
        }
    }
}