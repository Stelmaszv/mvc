<?php
namespace core\db;
use core\db\engins\pdo;
use core\db\engins\mysqli;
class db{ 
    private $engins=[];
    private $engin;
    function __construct(){
        $engin=$this->engins=['pdo'=>new pdo(),'mysqli'=>new mysqli()];
        $this->engin=$engin=$this->engins[config['db']['dbengin']];
    }
    public function get_Engin(){
        return $this->engin;
    } 
}