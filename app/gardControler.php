<?php
namespace App;
use App\Time;
use App\auth;
class gardControler{
    public function __construct($gards){
       $array=$gards::$registry;
       foreach ($array as $el =>$value){
           if(isset($_GET['view']) && isset($array[$el][$_GET['view']])) {
               if ($_GET['view'] == $array[$el][$_GET['view']]) {
                   $gards::getGard($el,$_GET['view'])->check();
               }
           }

       }
    }
}