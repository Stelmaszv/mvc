<?php
namespace AppControler;
use CoreMain\controller;
use AppHelpel\showUsersPagination;
class showUsers extends controller{
    function main() { 
      if($this->Settings['templete']){
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
    function settings(){
        $this->Settings['templete']=true;
    }
    function onConstract(){
        $this->pagination();
    }
    private function pagination(){
        $this->pagination=new showUsersPagination(25);
        $this->pagination->setSql('SELECT * FROM `users`');
    }
}

