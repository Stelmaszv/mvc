<?php
namespace CoreMain;
use CoreMain\sql;
use Corehelpel\urls;
use AppModel\authModel;
use Coreinterface\authInterface;
class auth implements authInterface{
    private $sql;
    public function __construct($data){
        $this->sql= new sql();
        $this->data= $data;
    }
    function loginStart(){
        $loginerros=array();
        $model=new authModel();
        $array=$model::where($this->data['login'],config['auth']['loginField'],'=');
        if($array){
            if(!password_verify($this->data['password'],$array[0]['password'])){
                
                $erros=array(
                    'error'=>'błędne hasło'
                );
                array_push($loginerros,$erros);
            }else{
                $erros=array(
                    'sucess'=>$array[0]
                );
                array_push($loginerros,$erros);
            }
        }else{
            $erros=array(
                'error'=>'nie ma takiego uzytkonika'
            );
            array_push($loginerros,$erros);

        }
        return $loginerros;
    }
    function setSession($data){
        $_SESSION['auth']=$data;
        urls::refresh();
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
        urls::refresh();
    }
    private function passwordCrypt($password){
        $pass =password_hash($password,PASSWORD_BCRYPT,config['auth']['passwordOptions']);
        return $pass;
    }
    function register(){

       $pass=$this->faindField(config['auth']['password']);
       $this->data[$pass]['value']=$this->passwordCrypt($this->data[$pass]['value']);
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
        $level= self::returnAuth()['level'];
        if($level==$required){
            return true;
        }else{
            return false;
        }

    }
}
