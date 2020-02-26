<?php
namespace core\main\controller;
class templete{
    private $code;
    public function init(string $file,array $attributes){
        $this->set_Templete($file);
        $file=$this->show_templpete();
        $file= $this->get_varables($attributes);
        $file= $this->get_ifs($file,$attributes);
        return $file;
    }
    private function get_ifs(string $file,array $attributes){
        preg_match_all('/{\sif\sname\s"[a-z]*"\s{[a-z]*}\s==\s[a-z]*\s}/',$file,$matches); 
        foreach($matches[0] as $mat){
            $pieces = explode(" ", $mat);
            $verable='{'.$pieces[4].'}';
            $value=$pieces[6];
            $if_name=$pieces[3];
            if($attributes[$verable] == $value){
                $file = str_replace($mat,'', $file);
                preg_match_all('/{\sifsection\s"kotek"\s}(.*){\sendif\s}/',$file,$ifsections);
                $if=$ifsections[0][0];
                $if_section_words = explode(" ", $if);
                $index=0;
                foreach($if_section_words as $if_section_word){
                    if($index<4 || $index>4){
                        $file = str_replace($if_section_word,'', $file);
                    }
                    $index=$index+1;
                }  
            }
        }
        return $file;
    }
    private function show_templpete(){
        return $this->code;
    }
    private function set_Templete(string $file){
        $this->code=file_get_contents($file);
    }
    private function get_varables(array $attributes){
        $file=$this->show_templpete();
        $pm=preg_match_all('/{{[a-z]*}}/',$file,$matches); 
        foreach($matches[0] as $mat){
            if(isset($attributes[$mat])){
                $file = str_replace($mat,$attributes[$mat], $file);
            }
        }
        return $file;
    }
}