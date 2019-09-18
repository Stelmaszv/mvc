<?php
namespace seeds;
use App\debag;
use model\users;
use App\randomUserData;
use App\sederBase;
class addUser extends sederBase{
    function seetings(){
        $this->model=new users();
        $this->count=1;
    }
    function execute(){
        $count=0;
        foreach ($this->usersGenerator() as $user) {
            $insert = array(
                array(
                    'field' => 'login',
                    'value' => $user->login->username
                ),
                array(
                    'field' => 'password',
                    'value' => $user->login->sha256
                ),
                array(
                    'field' => 'email',
                    'value' => $user->email
                ),
                array(
                    'field' => 'level',
                    'value' => 'user'
                ),
                array(
                    'field' => 'avatar',
                    'value' => $user->picture->medium
                )
            );
            if (users::insert($insert)) {
                $count++;
            }
            print "Added ".$count." / ".$this->count." to tabel ".users::showTableName()." \n";
        }
    }
}