<?php
namespace App;
use App\sql;
use generator\randomUserData;
abstract class sederBase{
    public $Model;
    public function __construct($count){
        $this->count=$count;
        $this->seetings();
    }
    function usersGenerator(){
        $users=new randomUserData($this->count);
        return $users->returnResults();
    }
    abstract function seetings();
    abstract function execute();
}