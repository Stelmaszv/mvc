<?php
namespace controler;
use app\controler;
use App\pagination;
use helpels\json;
class ajaxUsers extends controler{
    private function pagination(){
        $this->pagination=new pagination(30,$_GET);
        $this->pagination->setSql('SELECT * FROM `users`');
    }
    public function addElments(){
        $this->pagination();
        echo json::json_encode($this->pagination->loop);
    }
}
?>