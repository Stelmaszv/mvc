<?php
namespace core\main\controller;
class templete{
    private $code;
    private $varbles;
    public function init(string $file,array $attributes){
        $this->set_Templete($file);
        $file=$this->show_templpete();
        $file=$this->get_varables($attributes);
        $file=$this->get_ifs($file,$attributes);
        $file=$this->get_loops($file,$attributes);
        $file=$this->generate_templete($file);
        return $file;
    }
    private function set_Templete(string $file){
        $this->code=file_get_contents($file);
    }
    private function show_templpete(){
        return $this->code;
    }
    private function get_loops(string $file,array $attributes){
        preg_match_all('/{\sloop\sname\s"(.*)"\s(.*)}\s/i',$file,$loops); 
        foreach($loops[0] as $mat){
            $loop = explode(" ", $mat);
            $loop_name=$loop[3];
            $varable='{{'.$loop[4].'}}';
            if(is_array($attributes[$varable])){
                if(isset($attributes[$varable]) && count($attributes[$varable])){
                    $count_table=count($attributes[$varable]);
                    $loop_code = '';
                    $start_pos = strpos(strtolower($file), '{ loop name '.$loop_name.'}') + strlen('{ loop name '.$loop_name.'');
                    $end_pos = strpos(strtolower($file), '{ loopnd name '.$loop_name.'}');
                    $loop_code = substr($file, $start_pos, $end_pos-$start_pos);
                    $start_tag = substr($file, strpos(strtolower($file), '{ loop name '.$loop_name.' }'),strlen('{ loop name '.$loop_name.' }'));
                    $end_tag = substr($file, strpos(strtolower($file), '{ loopend name '.$loop_name.'}'),strlen('{ loopend name '.$loop_name.'}'));
                    if($loop_code != ''){
                        $new_code = '';
                        for($i=0; $i<$count_table; $i++){
                            $temp_code = $loop_code;
                            while(list($key,) = each($attributes[$varable][$i])){
                                $temp_code = str_replace('{'.$key.'}',$attributes[$varable][$i][$key], $temp_code);
                            }
                            $new_code .= $temp_code;
                        }
                        $file = str_replace($start_tag.$loop_code.$end_tag, $new_code, $file);
                    }
    
                }
            }else{
                die('varable loop must be array');
            }
        }
        return $file;
    }
    private function get_ifs(string $file,array $attributes){
        preg_match_all('/{\sif\sname\s"[a-z]*"\s{[a-z]*}\s==\s[a-z]*\s}/',$file,$matches); 
        foreach($matches[0] as $mat){
            $pieces = explode(" ", $mat);
            $verable='{'.$pieces[4].'}';
            $value=$pieces[6];
            $if_name=$pieces[3];
            $if_start='{ if name '.$if_name.' '.$pieces[4].' == '.$pieces[6].' }';
            $end_if='{ ifend name '.$if_name.' }';
            if($attributes[$verable] == $pieces[6]){
                $file = str_replace($if_start,'', $file);
                $file = str_replace($end_if,'', $file);
            }else{
                $comp='/'.$if_start.'\s(.*)\s'.$end_if.'/i';
                $file = preg_replace($comp, '', $file);
            }
        }
        return $file;
    }
    private function get_varables(array $attributes){
        $file=$this->show_templpete();
        $pm=preg_match_all('/{{[a-z]*}}/',$file,$matches); 
        foreach($matches[0] as $mat){
            if(isset($attributes[$mat])){
                $this->varbles[$mat]=$attributes[$mat];
            }
        }
        return $file;
    }
    private function generate_templete(string $file){
        while(list($key,$val)=each($this->varbles))
            $file = str_replace($key,$val,$file);
            $file = preg_replace('/\{{(.*?)}}/i', '', $file);
        return $file;
    }
}