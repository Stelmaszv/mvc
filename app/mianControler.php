<?php
namespace App;
use App\controler;
use App\gard;
use controler\header;
use controler\footer;
class mianControler extends  controler{
    function __construct($views){
        parent::__construct('./public/index.htm');
        $this->show=$views;
        if(isset($_GET['view']) && count($_GET)>0){
            gard::checkGards();
            $this->title=$_GET['title'];
        }else{
            $this->title='Home';
        }
    }
    function addElments(){
        $header= new header('./templete/header.htm');
        $footer= new footer('./templete/footer.htm');
        $this->templete->CAdd('[#heder#]',$header->view());
        $this->templete->CAdd('[#footer#]',$footer->view());
        $this->templete->CLoop('styles',styles);
        $this->templete->CLoop('scripts',scripts);
        $this->templete->CAdd('[#view#]',$this->show->view());
        $this->templete->CAdd('[#Title#]',$this->title);
    }
}
