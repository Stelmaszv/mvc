<?php
namespace core\main\migration\abstracts;
abstract class abstract_relation{
    protected $db;
    protected $querys=['actual'=>[],'added'=>[]];
    function FOREIGN_KEY(array $fun_argument,string $table): string
    {
        $FOREIGN_KEY_VALUE=$fun_argument['FOREIGN_KEY_VALUE'];
        $FOREIGN_KEY_REFERENCES=$fun_argument['FOREIGN_KEY_REFERENCES'];
        $FOREIGN_KEY_REFERENCES_KEY=$fun_argument['FOREIGN_KEY_REFERENCES_KEY'];
        return 'ALTER TABLE '.$table.' ADD FOREIGN KEY ('.$FOREIGN_KEY_VALUE.') REFERENCES '.$FOREIGN_KEY_REFERENCES.'('.$FOREIGN_KEY_REFERENCES_KEY.')';
    }
}