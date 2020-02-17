<?php
namespace core\interfaces;
interface migration_Interface{
    function Create(array $fun_argument): string;
    function Alter(array $fun_argument): string;
}