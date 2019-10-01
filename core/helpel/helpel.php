<?php
function vdab($array){
    echo '<pre>';
    echo var_dump($array);
    echo '</pre>';
}
function headerToUrl($url){
    header('Location: '.$url);
}
function generatecontrolerLink($name,$method=false){
    if(!$method){
        $method='main';
    }
    return config['projectUrl'].$name.'/'.$method.'/';
}
function setconrollerShema($name){
    return 'app/controlers/'.$name.'.htm';
}
function procentCount($numbers,$number){
    $all=array_sum($numbers);
    $elment=$numbers[$number];
    $prcent=$elment*100/$all;
    return $prcent;
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