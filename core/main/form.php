<?php
namespace CoreMain;
use Corelanguage\language;
class form{
    public function __construct($data){
        $this->data=$data;
        $this->checktypes();
    }
    function validate(){
        return $this->faindError();
    }
    function upload(){
        foreach ($this->data as $el){
            if($el['type']=='file'){
                $ext=strtolower(pathinfo(basename($el["value"]["name"]),PATHINFO_EXTENSION));
                $url=$el['fileSettings']['url'].'/'.basename($el["value"]["name"]);
                if(!is_dir($el['fileSettings']['url'])){
                    mkdir($el['fileSettings']['url']);
                }
                move_uploaded_file($el["value"]["tmp_name"],$url);
                if(isset($el['fileSettings']['newName'])){
                    rename($url, $el['fileSettings']['url'].'/'.$el['fileSettings']['newName'].'.'.$ext );
                }
            }
        }
    }
    function showErors(){
        $errors=array();
        foreach($this->data as $el){
            foreach($el['erros'] as $error){
                $errors[]=array(
                    'errorname'=>$error
                );
            }
        }
        if(count($errors)){
            return $errors;
        }else{
            return array();
        }
    }
    function readyTosent(){
        $items=array();
        foreach ($this->data as $el){
            if(isset($el['db'])){
                if($el['type']!='file') {
                    $item = array(
                        'field' => $el['db'],
                        'value' => $el['value']
                    );
                }else{
                    $item = array(
                        'field' => $el['db'],
                        'value' => $el['value']['name']
                    );
                }

                array_push($items,$item);
            }
        }
        return $items;
    }
    private function faindError(){
        $count=0;
        foreach($this->data as $el){
            if($el['stan']){
                $count=$count+1;
            }
        }
        if($count==0){
            return true;
        }
        return false;

    }
    private function checktypes(){
        foreach($this->data as $el=>$value){
            if(!empty($value['value'])) {
                $types = [];
                $types['text'] = new text();
                $types['password'] = new password();
                $types['email'] = new email();
                $types['file'] = new file();
                $this->data[$el] = $types[$value['type']]->execute($this->data[$el], $this->data);
            }else{
                if($this->data[$el]['require']) {
                    $emptyField=language::trnaslate('emptyField',false,'{name}',$this->data[$el]['name']);
                    $this->data[$el]['erros'] = array($emptyField);
                    $this->data[$el]['stan']=true;
                }
            }

        }
    }
}
abstract class validatebase{
    abstract function execute($el,$array);
    function lenght($el){
        $array= array();
        if(strlen($el['value'])>$el['max']){
            $tolong=language::trnaslate('tolong',false,'{name}',$el['name']);
            array_push($array,$tolong);
        }
        if(strlen($el['value'])<$el['min']){
            $tosmall=language::trnaslate('tosmall',false,'{name}',$el['name']);
            array_push($array,$tosmall);
        }
        return $array;
    }
    function faindField($array,$name){
        foreach($array as $el){
            if(isset($el[$name])) {
                if ($el[$name]) {
                    return $el;
                }
            }
        }
    }
    function setStan($array){
        if(count($array)>0){
            return true;
        }
        return false;

    }
    function addErrors($AddElments,$toAraray){
        foreach ($AddElments as $el){
            array_push($toAraray,$el);
        }
        return $toAraray;
    }
}
class text extends validatebase {
    function execute($el,$array){
        $array=$this->lenght($el);
        if(isset($el['unique'])) {
            if($this->ifUnique($el['unique'],$el)){
                $unique=language::trnaslate('unique',false,'{name}',$el['name']);
                array_push($array,$unique);
            };
        }
        $el['stan']=$this->setStan($array);
        $el['erros']=$array;
        return $el;
    }
    function ifUnique($obj,$el){
        return $obj[0]->unique($obj[1],$el['value']);
    }
}
class email extends validatebase {
    function execute($el,$array){
        $array=$this->lenght($el);
        if($this->ifEmial($el)){
            $wrongemail=language::trnaslate('wrongemail',false,'{name}',$el['name']);
            array_push($array,$wrongemail);
        }
        $el['stan']=$this->setStan($array);
        $el['erros']=$array;
        return $el;
    }
    function ifEmial($el){
        if (!filter_var($el['value'], FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
}
class password extends validatebase{
    function execute($el,$allElments){
        $array=$this->lenght($el);
        $passStrenght=$this->passwordstrng($el['value'],$this->faindField($array,'login'));
        if($this->chceckPassword($el,$allElments)){
            $passwordsWrong=language::trnaslate('passwordsWrong');
            array_push($array,$passwordsWrong);
        }
        if(count($passStrenght)>0){
            $passwordweeek=language::trnaslate('passwordweeek');
            array_push($array, $passwordweeek);
        }
        $array=$this->addErrors($passStrenght,$array);
        $el['stan']=$this->setStan($array);
        $el['erros']=$array;
        return $el;
    }
    function chceckPassword($el,$array){
        $passwordConfirm=$this->faindField($array,'passwordConfirm');
        if($passwordConfirm['value']!=$el['value']){
            return true;
        }
        return false;
    }
    function passwordstrng($pass,$user){
        $passwordErrors=array();
        if(strlen($pass)<6){
            $passwordshort=language::trnaslate('passwordshort');
            array_push($passwordErrors,$passwordshort);
        }
        $uc = 0;
        $lc = 0;
        $num = 0;
        $other = 0;
        for ($i = 0, $j = strlen($pass); $i < $j; $i++) {
            $c = substr($pass,$i,1);
            if (preg_match('/^[[:upper:]]$/',$c)) {
                $uc++;
            } elseif (preg_match('/^[[:lower:]]$/',$c)) {
                $lc++;
            } elseif (preg_match('/^[[:digit:]]$/',$c)) {
                $num++;
            } else {
                $other++;
            }
        }
        $max = $j - 2;
        if ($uc > $max) {
            $tomenyLower=language::trnaslate('tomenyUper');
            array_push($passwordErrors,$tomenyLower);
        }
        if ($lc > $max) {
            $tomenyLower=language::trnaslate('tomenyLower');
            array_push($passwordErrors,$tomenyLower);
        } if ($num > $max) {
            $tomenynumeral=language::trnaslate('tomenynumeral');
            array_push($passwordErrors,$tomenynumeral);
        }
        if ($other > $max) {
            $tomenynumeral=language::trnaslate('tomenyspecial');
            array_push($passwordErrors,$tomenynumeral);
        }
        return $passwordErrors;
    }
}
class file extends validatebase{
    public function execute($el, $array){
        $array=[];
        if($this->isstFile($el)) {
            $emptyFile=language::trnaslate('emptyFile',false,'{name}',$el['name']);
            array_push($array,$emptyFile);
        }
        if($this->ifSize($el)){
            $tobigFile=language::trnaslate('tobigFile',false,'{name}',$el['name']);
            array_push($array, $tobigFile);
        }
        if($this->ifExt($el)){
            $ext=language::trnaslate('ext',false,'{name}',$el['name']);
            array_push($array,$ext);
        }
        $el['erros']=$array;
        return $el;
    }
    private function isstFile($el){
        if(empty($el['value']['name'])){
            return true;
        }
        return false;
    }
    private function ifSize($el){
        if($el['value']['size']>$el['fileSettings']['maxsize']){
            return true;
        }
        return false;
    }
    private function ifExt($el){
        $ext=strtolower(pathinfo(basename($el["value"]["name"]),PATHINFO_EXTENSION));
        $exts=$el["fileSettings"]['ext'];
        $count=0;
        foreach($exts as $elext){
            if($elext==$ext){
                $count=$count+1;
            }
        }
        if($count>0){
            return false;
        }
        return true;
    }
}