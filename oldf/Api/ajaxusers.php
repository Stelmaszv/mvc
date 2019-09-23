<?php


namespace Api;


use App\apiRequest;
use App\pagination;
use helpels\debag;
use helpels\json;

class ajaxusers extends apiRequest{
    private function pagination(){



        $this->pagination=new pagination(50,$_GET);
        $this->pagination->setSql('SELECT * FROM `users`');
    }
    public function show(){
        $this->pagination();
        echo json::json_encode(array('info'=>$this->pagination->returnpagesInfo(),'result'=>$this->pagination->loop));
    }
}