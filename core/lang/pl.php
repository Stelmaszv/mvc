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
        'dataError'  => 'Nie można znalisc danych w modelu prametry :pole={field},wartość={where}',
        //validation
        'tomenyUper' =>'W hasle znajduje sie za dużo ducych liter',
        'tomenyLower' =>'W hasle znajduje sie za dużo małych liter',
        'tomenynumeral'  => 'W hasle znajduje sie za dużo cyfr',
        'tomenyspecial'  => 'W hasle znajduje sie za znków specjalnych',
        'passwordshort' =>'Hasło jest za krótkie',
        'passwordistoweeek'=>'Hasło jest za słabe',
        'emptyFile'       =>'Nie dodano pliku w polu  {name}',
        'tobigFile'       =>'Plik w polu {name} jest za duży',
        'ext'             =>'Plik w polu {name} ma nieprwidłowe rozszezenie',
        'wrongemail'   =>'pole {name} ma nieprawidły email',
        'unique'   =>'Pole o nazwie {name} już isnieje',
        'tolong'=>'Pole {name} ma za dużo znaków',
        'tosmall'=> 'Pole {name} ma za mało znaków',
        'emptyField'=>'Pole {name} jest puste'
    )
);
define('language',$language);
