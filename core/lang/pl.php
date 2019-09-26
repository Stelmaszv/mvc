<?php
$language=array(
    'settings'=> array('sex'=>'a'),
    'translate'=>array(
        'welcome' => 'Witaj ma mojej stronie',
        'like'    => '{Name} polubił{SEX} twój post',
        'TemplateEror' => 'Plik templete o nazwie {className} nie istnieje',
        'ControlerMethodError' => 'Metoda {function} nie istnieje w kontrolerze o nazwie {controler}',
        'ControllerExistError'  => 'Kontroler o nazwie {name} nie istnieje',
        'DBError'=> 'Nie można połączyc z bazą danych sprawdz połacznie',
        'ModeltableError'=> 'Niezdefiowana tabeli w modelu {model} albo tabela nie istnieje',
        'urlLanght'=> 'Brakuje {Langht}/{required} prametrów w adresie w kontrolerze {controler}',
        'dataError'  => 'Nie można znalisc danych w modelu prametry :pole={field},wartość={where}'
    )
);
define('language',$language);
