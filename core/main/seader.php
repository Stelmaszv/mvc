<?php
namespace CoreMain;
abstract class seader{
    function __construct($lenght){
        $this->seetings();
        $this->execute($lenght);
    }
    abstract function execute($lenght);
}
