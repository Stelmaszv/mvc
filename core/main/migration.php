<?php
//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
//CREATE TABLE IF NOT EXISTS test (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`), login varchar(100) COLLATE utf8_polish_ci NOT NULL , email varchar(100) COLLATE utf8_polish_ci NOT NULL );
namespace CoreMain;
use CoreMain\sql;
abstract class migration{
    private  $elemnts=[];
    private  $sql;
    public function __construct(){
       $this->sql= new sql();
       $this->create();
    }
    abstract function run();
    private function create(){
        $this->elemnts=$this->run();
        if(!$this->faindTable($this->elemnts['table'])) {
            $query = 'CREATE TABLE IF NOT EXISTS ' . $this->elemnts['table'];
            $Fields = $this->elemnts['FIELDS'];
            $query .= ' (';
            $count = 0;
            foreach ($Fields as $el => $value) {
                $query .= $el . ' ' . $Fields[$el]['type'] . '(' . $Fields[$el]['lenght'] . ')';
                $query .= $this->addElemnt($this->elemnts['COLLATE'], $el);
                if ($count != count($Fields) - 1) {
                    $query .= ', ';
                }

                $count++;
            }
            $query .= ');';
            $sql = new sql();
            if($sql->MsQuery($query)){
                print "Table ".$this->elemnts['table']." has bean created  \n";
            }
        }
    }
    private function faindTable($table){
        $tableList=$this->sql->SqlloopAll('SHOW tables');
        foreach ($tableList as $el){
            if($el['Tables_in_test']==$table){
                return true;
            }
        }
        return false;
    }
    private function addElemnt($collate,$el){
        $add='';
        if($el!=$this->elemnts['PRIMARYKEY']){
            $add.=" COLLATE";
            foreach ($collate as $addEl){
                $add.=' '.$addEl.' ';
            }
        }else{
            $add.=' '.$this->elemnts['NULL'].' ';
            $add.="AUTO_INCREMENT";
            $add.=",PRIMARY KEY (`".$el."`)";
        }

        return $add;
    }


}