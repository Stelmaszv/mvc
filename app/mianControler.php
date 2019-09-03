<?php
namespace App;
use App\controler;
use App\CTemplate;
use App\gard;
use controler\home;
use controler\start;
use controler\login;
use controler\register;
use controler\showSection;
use controler\showUsers;
use controler\logout;
use controler\header;
use controler\footer;
class mianControler extends  controler{
    function __construct(){
        parent::__construct('./public/index.htm');
        if(isset($_GET['view']) && count($_GET)>0){
            gard::checkGards();
            $this->title=$_GET['title'];
            $this->controlers($_GET['view']);
        }else{
            $this->title='Home';
            $this->controlers('');
        }
    }
    function addElments(){
        $header= new header('./templete/header.htm');
        $footer= new footer('./templete/footer.htm');
        $this->templete->CAdd('[#heder#]',$header->view());
        $this->templete->CAdd('[#footer#]',$footer->view());
        $this->templete->CLoop('styles',styles);
        $this->templete->CLoop('scripts',scripts);
    }
    private function controlers($el){

        $controlers=[];
        $controlers['']= new home('./templete/home.htm');
        $controlers['start']= new start('./templete/start.htm');
        $controlers['login']= new login('./templete/login.htm');
        $controlers['register']= new register('./templete/register.htm');
        $controlers['showSection']= new showSection('./templete/showSection.htm');
        $controlers['showUsers']= new showUsers('./templete/showUsers.htm');
        $controlers['logout']= new logout('./templete/showUsers.htm');
        $this->templete->CAdd('[#view#]',$controlers[$el]->view());
        $this->templete->CAdd('[#Title#]',$this->title);

    }
}