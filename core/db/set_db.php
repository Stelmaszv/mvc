<?php
namespace core\db;
use core\db\engins\pdo;
use core\db\engins\mysqli;
use core\db\interfaces\db_interface as DB;
class set_db{ 
    private $engin;
    function __construct(){
        $this->engin=$this->set_Engin(config['db']['dbengin']);
    }
    //factory method
    private function set_Engin(string $engin) : DB
    {
        switch($engin) {
            case 'pdo':
                return new pdo();
            break;
            case 'mysqli':
                return new mysqli();
            break;
        }
    } 
    public function get_Engin() : DB
    {
        return $this->engin;
    }
}