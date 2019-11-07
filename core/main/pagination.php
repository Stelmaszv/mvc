<?php
namespace CoreMain;
use CoreMain\sql;
use controler\header;
class pagination{
     public  $pagesCount;
     private $url;
     public  $limitOnPage;
     private $sql;
     public  $next;
     public  $back;
     public  $corentPage;
    public function __construct($limitOnPage){
        $this->defult=$this->returndefult();
        $this->CorentPage = isset($_GET['page']) && !empty($_GET['page'])  ? intval($_GET['page']):1;
        $this->sql = new sql();
        $this->limitOnPage = $limitOnPage;
        $this->skip = (($this->CorentPage - 1) * $this->limitOnPage);
    }
    public function returnpagesInfo(){
        return array(
            'lastPage'=> $this->pagesCount,
            'CorrentPage'=>$this->CorentPage
        );
    }
    private function returndefult(){
        return 'http://localhost/mvc/'.url[0];
    }
    private function headerBlock(){
        if(!isset($this->CorentPage)){
            $this->AddPage(1);
            header("Location: index.php".$this->url."");
        }else{
            if($this->CorentPage>$this->pagesCount){
                $this->AddPage($this->pagesCount);
                header("Location: index.php".$this->url."");
            }else if($this->CorentPage<0){
                $this->AddPage(1);
                header("Location: index.php".$this->url."");
            }

        }
    }
    private function AddPage($page){
        $this->url=$this->defult.'?page='.$page;
    }
    public function setSql($sql){
        $this->query=$sql;
        $this->PrepearQuery();
    }
    private function PrepearQuery(){
        $total=$this->sql->CountsSql($this->query);
        $this->pagesCount=\ceil($total/$this->limitOnPage);
        $queryAdd=' LIMIT '.$this->skip.', '.$this->limitOnPage;
        $this->query.=$queryAdd;
        $this->loop=$this->sql->SqlloopAll($this->query);
        $this->setRecords();
        $this->headerBlock();
    }
    public function setRecords(){}
    public function ifBack(){
        if($this->CorentPage>1){
            $this->back=true;
            $back=$this->CorentPage - 1;
            $this->AddPage($back);
            return $this->url;
        }else{
            $this->back='dqwd';
        }
    }
    public function ifNext(){
        if($this->CorentPage<$this->pagesCount){
            $next=$this->CorentPage + 1;
            $this->next=true;
            $this->AddPage($next);
            return $this->url;
        }else{
            $this->next=false;
        }

    }
    private function ifLast($el){
        if($el==$this->pagesCount){
            return true;
        }
        return false;
    }
    private function ifFirst($el){
        if($el==1){
            return true;
        }
        return false;
    }
    private function ifCorentPage($el){
        if($this->CorentPage==$el){
            return true;
        }
        return false;
        
    }
    private function returnClass($el){
        if($this->ifCorentPage($el)){
            return 'corrent';
        }
        if($this->ifFirst($el)){
            return 'first';
        }
        if($this->ifLast($el)){
            return 'last';
        }
    }
    public function returnFirst(){
        $this->AddPage(1);
        return $this->url;
    }
    public function returnLost(){
        $this->AddPage($this->pagesCount);
        return $this->url;
    }
    public function returnPages($limit=false){
        $pages=[];
        if(!$limit) {
            for ($i=1; $i <= $this->pagesCount; $i++) {
                $this->AddPage($i);
                    $pages[] = array(
                        'page' => $i,
                        'link' => $this->url,
                        'class'=>$this->returnClass($i),
                        'ifCorent' => $this->ifCorentPage($i),
                        'first'=>$this->ifFirst($i),
                        'last'=>$this->ifLast($i)
                    );
            }
        }else{
            $max= $this->CorentPage+$limit-1;
            $mini=$this->CorentPage-$limit+1;

            for ($i=1; $i <= $this->pagesCount; $i++) {
                $this->AddPage($i);
                $link='';
                if($i>=$mini && $i<=$this->CorentPage-1){
                    if($i!=1) {
                        $pages[] = array(
                            'page' => $i,
                            'link' => $this->url,
                            'class'=>$this->returnClass($i),
                            'ifCorent' => $this->ifCorentPage($i),
                            'first' => $this->ifFirst($i),
                            'last' => $this->ifLast($i),
                        );
                    }
                }
                if($i >=$this->CorentPage && $i<=$max) {
                    if($i!=$this->pagesCount) {
                        $pages[] = array(
                            'page' => $i,
                            'link' => $this->url,
                            'class'=>$this->returnClass($i),
                            'ifCorent' => $this->ifCorentPage($i),
                            'first' => $this->ifFirst($i),
                            'last' => $this->ifLast($i)
                        );
                    }
                }
            }
        }
        return $pages;
    }

}