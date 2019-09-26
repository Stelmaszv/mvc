<?php
namespace AppHelpel;
use CoreMain\pagination;
class showUsersPagination extends pagination{
    public function setRecords(){
        foreach($this->loop as $el =>$value){
            $this->loop[$el]['editControler']=generatecontrolerLink('edituser').$this->loop[$el]['id'];
            $this->loop[$el]['showControler']=generatecontrolerLink('showuser').$this->loop[$el]['id'];
            $this->loop[$el]['deleteControler']=generatecontrolerLink('deleteuser').$this->loop[$el]['id'];
        }
    }
}
