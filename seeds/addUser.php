<?php
namespace seeds;
use App\debag;
use App\sederBase;
class addUser extends  sederBase{
    public function __construct(){
        parent::__construct();
        $this->table='users';
        $this->items=1;
    }
    function prepeare(){
        foreach ($this->randomUser->returnResults() as $row){
            $this->elments[]=array(
                '1'=> $row->login->username,
                '2'=> $row->login->sha256,
                '3'=>'user',
                '4'=> $row->email
            );
        }
        debag::varDump($this->elments);
        /*
        $this->randomUser->returnResults();
        $this->elments[0]=array(
            'field'=>'login',
            'value'=> $this->randomUser->returnResults()[0]->login->username
        );
        $this->elments[1]=array(
            'field'=>'password',
            'value'=> $this->randomUser->returnResults()[0]->login->sha256
        );
        $this->elments[2]=array(
            'field'=>'level',
            'value'=> 'user'
        );
        $this->elments[3]=array(
            'field'=>'email',
            'value'=> $this->randomUser->returnResults()[0]->email
        );
        */
    }
}