<?php
namespace app;
class randomString{
    static function generate($lenght){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $lenght; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
}
class rand{
    static public function randNumber($min,$max){
        return rand($min, $max);
    }
    static public function arrayround($array){
        return $array[array_rand($array,1)];
    }
}
class randomImg{
    public function __construct(){
        $this->el=1;
        $this->setSetting();
    }
    private function setSetting(){
        $this->setSize();
        $this->basicUrl='https://picsum.photos/'.$this->width.'/'.$this->height.'?random='.$this->el;
    }

    public function  generate($el=false){
        $this->el=$el;
        $this->setSetting();
        return $this->basicUrl;
    }
    public  function setSize(){
        $this->width=200;
        $this->height=300;
    }
}
class randomUserData{
    public function __construct(){
        $this->webCrawler = new webCrawler('https://randomuser.me/api/?format=json&results=1');
        $this->webCrawler->url = json_decode($this->webCrawler->url);
    }
    public function returnResults(){
        return  $this->webCrawler->url->results;
    }
}

?>
