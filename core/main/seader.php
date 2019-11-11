<?php
namespace CoreMain;
use Coreinterface\seaderinterface;
abstract class seader implements seaderinterface{
    function __construct($lenght){
        $this->seetings();
        $this->execute($lenght);
    }
}
