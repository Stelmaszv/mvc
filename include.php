<?php
interface includeItems{
    function execute();
}
class includeFiles implements includeItems {
    var $dir;
    function __construct($dir){
        $this->dirStr=$dir;
        $this->dir=opendir($dir);
    }

    function execute(){
        $index=0;
        while (($file = readdir($this->dir))){
            if($index>1){
                include $this->dirStr.'/'.$file;
            }
            $index++;
        }

    }
}

$app = new includeFiles('app');
$controlers = new includeFiles('controlers');
$actions = new includeFiles('actions');
$model = new includeFiles('model');
$app->execute();
$model->execute();
$controlers->execute();
$actions->execute();
?>