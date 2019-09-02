<?php
class  showSection extends controler{
    public function addElments(){
        if(auth::ifAuth()){
            $auth=auth::returnAuth();
           $this->templete->CAdd('[#Session#]',$auth['login']);
        }

    }
}
