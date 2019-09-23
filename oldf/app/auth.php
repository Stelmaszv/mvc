<?php
namespace App;
use App\sql;
use helpels\urls;
use model\authModel;
session_start();
interface authInterface{
    function loginStart();
    static function ifAuth();
    static function returnAuth();
    static function logout();
    function register();
}
class auth implements authInterface{
    private $sql;
    public function __construct($data){
        $this->sql= new sql();
        $this->data= $data;
    }
    function loginStart(){
        $model=new authModel();
        $array=$model::where($this->data['login'],auth['loginField'],'=');
        if(password_verify($this->data['password'],$array[0]['password'])){
           $this->setSession($array);
        }else{
            $url=new urls();
            $url->addToIssetUrl('&&error=true');
            $url->redirect();
        }
    }
    private  function setSession($data){
        $_SESSION['auth']=$data;
        $url=new urls();
        $url->redirect();
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
    static function logout(){
        session_destroy();
        $url=new urls();
        $url->redirect();
    }
    private function passwordCrypt($password){
        $pass =password_hash($password,PASSWORD_BCRYPT,passwordOptions);
        return $pass;
    }
    function register(){
        $pass=$this->faindField(auth['password']);
        $this->data[$pass]['value']=$this->passwordCrypt($this->data[$pass]['value']);
        array_push($this->data,array("field"=>'level',"value"=>'user'));
        $id=authModel::insert($this->data);
        $this->setSession(authModel::faind($id));
    }
    private function faindField($field){
        foreach ($this->data as $el=>$value){
            if($this->data[$el]['field']==$field){
                return $el;
            }

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
