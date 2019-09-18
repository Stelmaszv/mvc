<?php
namespace generator;
use helpels\json;
use App\webCrawler;

class randomUserData{
    public function __construct($count){
        $this->webCrawler = new webCrawler('https://randomuser.me/api/?format=json&results='.$count);
        $this->webCrawler->url = json::json_decode($this->webCrawler->url);
    }
    public function returnResults(){
        return  $this->webCrawler->url->results;
    }
}