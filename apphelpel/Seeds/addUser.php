<?php
namespace AppSeeds;
use CoreMain\seader;
use CoreMain\sql;
use Appgenerator\randomUserData;
use AppModel\users;
class addUser extends seader{
    function seetings(){
        $this->model=new users();
        //$this->data=$users->returnResults();
    }
    function execute($lenght){
        $this->count=$lenght;
        $users=new randomUserData($lenght);
        $this->data=$users->returnResults();
        $count=0;
        foreach ($this->data as $user) {
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
            if ($this->model::insert($insert)) {
                $count++;
            }
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            print "Adding ".round(procentCount(array($count,$this->count-$count),0))."% records  to tabel ".$this->model::showTableName()." \r\n";
        }
        
    }
}
/*
namespace AppSeeds;
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
            if ($this->model::insert($insert)) {
                $count++;
            }
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            print "Adding ".round(math::procentCount(array($count,$this->count-$count),0))."% records  to tabel ".users::showTableName()." \r\n";
        }
    }
}
*/