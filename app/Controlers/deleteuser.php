<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use Corehelpel\urls;
class deleteuser extends controller{
    function main(){
        new users();
        users::delete(url[2]);
        urls::setLocation(generatecontrolerLink('showUsers'));
    }
    function settings(){
        $this->Settings['templete']=false;
        $this->Settings['requiredUrl']=3;
    }
}