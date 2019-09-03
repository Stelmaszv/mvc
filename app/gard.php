<?php
namespace App;
class gard{
    function __construct(){
        $this->auth=new auth();
    }
    static public function checkGards(){
        foreach (gards as $gard){
            if($gard['route']==$_GET['view']) {
                switch ($gard['level']) {
                    case 'session':
                        if (!auth::ifAuth()) {
                            header('Location:'.loginLocation);
                            exit();
                        }
                        break;
                    case 'nosession':
                        if (auth::ifAuth()) {
                            header('Location:'.homeLocation);
                            exit();
                        }
                        break;
                    case 'admin':
                        if (auth::ifAuth()) {
                            if(auth::returnAuth()['level']!='admin'){
                                header('Location:'.homeLocation);
                            }

                        }else{
                            header('Location:'.loginLocation);
                        }

                        break;
                }
            }
        }
    }
}