<?php
namespace App;
class includeFiles{
    function addElemnts($dir){
        $count = 0;
        if ($handle = opendir($dir)) {
            $items = array();
            while (false !== ($file = readdir($handle))) {
                if (($file <> ".") && ($file <> "..")) {
                    $items[]=array(
                        'name'=>$dir.''.$file
                    );
                }
            }
            closedir($handle);
           return  $items;
        }
    }

}