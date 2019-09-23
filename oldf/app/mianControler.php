<?php
namespace App;
use App\controler;
use controler\header;
use controler\footer;
use helpels\debag;

class mianControler extends  controler{
    function __construct($views){
        parent::__construct('./public/index.htm');
        $this->show=$views;
        if(isset($_GET['view']) && count($_GET)>0){
            $this->title=$_GET['title'];
        }else{
            $this->title='Home';
        }

    }
    function addElments(){
         $header= header::create();
         $footer= footer::create();
         $this->templete->CAdd('[#heder#]',$header->view());
         $this->templete->CAdd('[#footer#]',$footer->view());
         $this->templete->CLoop('stylesassets',stylesAssets);
         $this->templete->CLoop('stylesurls',stylesUrls);$this->templete->CLoop('styles',styles);
         $this->templete->CLoop('scriptsassets',scriptsAssets);
         $this->templete->CLoop('scripts',scripts);
         $this->templete->CLoop('scriptsurl',scriptsUrls);
         $this->templete->CAdd('[#view#]', $this->show->view());
         $this->templete->CAdd('[#Title#]',$this->title);
    }
}
