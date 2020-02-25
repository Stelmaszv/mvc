<?php
namespace AppControler;
use CoreMain\controller;
use AppHelpel\showUsersPagination;
class showUsers extends controller{
    private $pagination;
    public function onConstract(){
        $this->pagination();
    }
    public function main() { 
      if($this->Settings['templete']){
        $this->addElemnts();
      }
    }
    public function settings(){
        $this->Settings['templete']=true;
    }
    private function pagination(){
        $this->pagination=new showUsersPagination(30);
        $this->pagination->setSql('SELECT * FROM `users`');
    }
    private function addElemnts(){
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

