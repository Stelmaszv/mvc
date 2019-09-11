<?php
namespace seeds;
use App\debag;
use App\sederBase;
use App\randomUserData;
class addUser extends  sederBase{
    protected  $elments=[];
    public function __construct($elemnts){
        $this->items= new randomUserData($elemnts);
        $this->table='users';
        parent::__construct();
    }
    function prepeare(){
        foreach ($this->items->returnResults() as $row){
            $this->elments[]=array(
                '1'=> $row->login->username,
                '2'=> $row->login->sha256,
                '3'=>'user',
                '4'=> $row->email
            );
        }
    }

}