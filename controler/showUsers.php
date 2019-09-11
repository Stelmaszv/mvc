<?php
namespace controler;
use App\controler;
use App\debag;
use App\pagination;
use model\users;

class showUsers extends controler{
    public function __construct($templete = false){
        parent::__construct($templete);
    }
    private function pagination(){
        $this->pagination=new pagination(35,$_GET);
        $this->pagination->setSql('SELECT * FROM `users`');
    }

    public function addElments(){
        $this->pagination();
       $user=new users();
       $this->templete->CLoop('users',$this->pagination->loop);
       $this->templete->CLoop('pages',$this->pagination->returnPages(10));
       $this->templete->CAdd('[#back#]',$this->pagination->ifBack());
       $this->templete->CAdd('[#next#]',$this->pagination->ifNext());
       $this->templete->CIf('back',$this->pagination->back);
       $this->templete->CIf('next',$this->pagination->next);
       $this->templete->CAdd('[#first#]',$this->pagination->returnFirst());
       $this->templete->CAdd('[#lost#]',$this->pagination->returnLost());
       $this->templete->CAdd('[#lostNumber#]',$this->pagination->pagesCount);
    }
}