<?php
function vdab($array){
    echo '<pre>';
    echo var_dump($array);
    echo '</pre>';
}
function headerToUrl($url){
    header('Location: '.$url);
}
