<?php
namespace core\main\controller\templete;
use core\main\controller\templete\templete_PHP;
use core\main\controller\templete\templete_HTML;
use core\main\controller\templete\API;
use core\main\controller\templete\templete_interface;
use core\exception\catch_exception;
class templete_Switch{
    public function return_obj(string $file,array $arguments) : templete_interface
    {
        switch(config['controller']['templete']){
            case 'PHP';
                $templete=new templete_PHP;
            break;
            case 'HTML';
                $templete=new templete_HTML;
            break;
            case 'API';
                $templete=new API;
            break;
        }

        if(config['controller']['templete']!='API'){
            if($file){
                $templete->init($file,$arguments);
                return $templete;
            }
            catch_exception::throw_New('Templete "'.$file.'" not foud ',false);
        }
        $templete->init($file,$arguments);
        return $templete;
    }
}