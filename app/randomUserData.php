<?php
namespace App;
class randomUserData{
    public function __construct($items){
        $this->webCrawler = new webCrawler('https://randomuser.me/api/?format=json&results='.$items);
        $this->webCrawler->url = json_decode($this->webCrawler->url);
    }
    public function returnResults(){
        return  $this->webCrawler->url->results;
    }
}