<?php
namespace generator;
use helpels\json;
use App\webCrawler;

class randomUserData{
    private $count;
    public function __construct($count){
        $this->count=$count;
        $this->webCrawler = new webCrawler('https://randomuser.me/api/?format=json&results='.$count);
        $this->webCrawler->url = json::json_decode($this->webCrawler->url);
    }
    public function returnResults(){
        if($this->count) {
            return $this->webCrawler->url->results;
        }
        return array();
    }
}