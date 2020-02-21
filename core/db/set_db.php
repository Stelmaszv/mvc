<?php
namespace core\db;
use core\db\engins\pdo;
use core\db\engins\mysqli;
class set_db{ 
    private $engin;
    function __construct(){
        $this->engin=$this->set_Engin(config['db']['dbengin']);
    }
    //factory method
    private function set_Engin(string $engin){
        switch($engin) {
            case 'pdo':
                return new pdo();
            break;
            case 'mysqli':
                return new mysqli();
            break;
        }
    } 
    public function get_Engin(){
        return $this->engin;
    }
}