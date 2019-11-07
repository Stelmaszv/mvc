<?php
namespace AppHelpel;
use CoreMain\pagination;
class showUsersPagination extends pagination{
    public function setRecords(){
        foreach($this->loop as $el =>$value){
            $this->loop[$el]['editControler']=generatecontrolerLink('showuser','edit').$this->loop[$el]['id'];
            $this->loop[$el]['showControler']=generatecontrolerLink('showuser','main').$this->loop[$el]['id'];
            $this->loop[$el]['deleteControler']=generatecontrolerLink('showuser','delete').$this->loop[$el]['id'];
        }
    }
}
