<?php
namespace seeds;
use App\debag;
use helpels\math;
use model\users;
use App\randomUserData;
use App\sederBase;
class addUser extends sederBase{
    function seetings(){
        $this->model=new users();
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
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            print "Adding ".round(math::procentCount(array($count,$this->count-$count),0))."% records  to tabel ".users::showTableName()." \r\n";
        }
    }
}