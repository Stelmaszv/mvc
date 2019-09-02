<?php
abstract class actionlist{
    public function __construct($action){
        if(isset($action['submit'])){
            $this->action=$action['submit'];
            $this->execute($action);
        }
    }
    abstract function execute($array);
}
abstract class action{
    abstract protected function execute($array);
    static function issetAction($value=false){
        if(!$value){
            $value='submit';
        }
        if(isset($_POST[$value])){
            return true;
        }
    }
}
class actionPost extends actionlist{
    function execute($array){
        $action=[];
        $action['test']= new testPost($array);
        $action['loginStart']= new loginAction($array);
        $action['register']= new registerAction($array);
        $action[$this->action]->execute($array);
    }
}

?>