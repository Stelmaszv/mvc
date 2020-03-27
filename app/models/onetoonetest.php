<?php 
    namespace app\models; 
    use core\main\model\abstract_model;
        class onetoonetest extends abstract_model { 
        function validate() : void 
        {
            $this->add([
                "colum"    => ,
                "type"     =>$this->(),
                "relation" =>,
            ])
            
            $this->add([
                "colum"    => ,
                "type"     =>$this->varchar(),
                "relation" =>,
            ])
            
            $this->add([
                "colum"    => text,
                "type"     =>$this->varchar(),
                "relation" =>true,
            ])
            
        }
        }