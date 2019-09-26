<?php
namespace Corelanguage;
class language{
    function __construct(){
        $this->setLanguage();
    }
    /* setLanguage to session */
    private function setLanguage(){
        if(!isset($_SESSION['language'])){
            $_SESSION['language']=config['defultlanguage'];
        }
        require($_SESSION['language'].'.php');
    }
    /* changeLanguage in the session */
    static function changeLanguage($lang){
        $_SESSION['language']=$lang;
    }
     /* this function is use for trnalate when is a varable in the string or use sex  
exception */
    static function trnaslate($word,$sexSet=false,$searchfor,$value,$array=true){
        if($array){
            $word=language['translate'][$word];
        }
        $sex = strstr($word, "{SEX}");
        if($sex){ // checking sex
            if($sexSet=='F'){
                $word=str_replace("{SEX}",language['settings']['sex'],$word);
            }else{
                $word=str_replace("{SEX}",'',$word);
            }
        }
        if($searchfor){
            $word=str_replace($searchfor,$value,$word);
        }
        return $word;
    }
    static function getWord($word){
        return language['translate'][$word];
    }
}

