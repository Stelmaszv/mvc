<?php
namespace CoreMain;
class webCrawler{
    public $url;
    public function __construct($url){
        $this->url=file_get_contents($url, false, stream_context_create($this->setting()));
    }
    private function setting(){
        array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Accept-language: en\r\n" .
                    "Cookie: foo=bar\r\n"
            )
        );
    }
}