<?php
namespace App;
use App\authInterface;
use App\sql;
session_start();
class auth extends authInterface{
    private $sql;
    public function __construct(){
        $this->sql= new sql();
    }
    function faindUsertoLogin($data){
        $array=$this->sql->SqlloopAll('SELECT * FROM `users` WHERE `login` = "'.$this->sql->escepeString($data['login']).'"');
        if(password_verify($data['password'],$array[0]['password'])){
            $this->setSession($array);
        }
    }
    private  function setSession($data){
        $_SESSION['auth']=$data;
        header('Location:'.homeLocation);
    }
    static function ifAuth(){
        if(isset($_SESSION['auth'])){
            return true;
        }else{
            return false;
        }

    }
    static function returnAuth(){
        return $_SESSION['auth'][0];
    }
    function logout(){
        session_destroy();
        header('Location:'.homeLocation);
    }
    private function passwordCrypt($password){
        $pass =password_hash($password,PASSWORD_BCRYPT,passwordOptions);
        return $pass;
    }
    function register($array){
        if(!$this->sql->CountsSql('SELECT * FROM `users` WHERE `login` = "'.$this->sql->escepeString($array['login']).'"') >0) {
            $array['email'] ='email.com';
            $this->sql->MsQuery('INSERT INTO `users` (`id`, `login`, `password`, `level`, `email`) VALUES (NULL,"'.$this->sql->escepeString($array['login']).'", "'.$this->sql->escepeString($array['password']).'", "user", "'.$this->sql->escepeString($array['email']).'")');
            $array=$this->sql->SqlloopAll('SELECT * FROM `users` WHERE `id` = '.intval($this->sql->lostId()).'');
            $this->setSession($array);
        }
    }
    static function ifLevel($required){
        $level= \app\auth::returnAuth()['level'];
        if($level==$required){
            return true;
        }else{
            return false;
        }

    }
}
