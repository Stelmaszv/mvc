<?php
function vd($array){
    echo '<pre>';
    echo var_dump($array);
    echo '</pre>';
}
function includeMedia($dir){
    if(!is_array($dir)){
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
    }else{
       $items = array();
       foreach($dir as $el){
           $items[]=array(
            'name'=>$el
           );
       }
       return  $items;
    }
}
/*
function headerToUrl(string $url){
    header('Location: '.$url);
}
function generatecontrolerLink(string $name,$method=false){
    if(!$method){
        $method='main';
    }
    return config['projectUrl'].$name.'/'.$method.'/';
}
function setconrollerShema(string $name){
    return 'app/controlers/'.$name.'.htm';
}
function procentCount(int $numbers,int $number){
    $all=array_sum($numbers);
    $elment=$numbers[$number];
    $prcent=$elment*100/$all;
    return $prcent;
}

*/