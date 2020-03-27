<?php 
    namespace app\models; 
    use core\main\model\abstract_model;
            use app\models\ onetoonetest;
        class modelrendertest extends abstract_model { 
        function validate() : void 
        {
            $this->add([
                "colum"    => ,
                "type"     =>$this->(),
                "relation" =>,
            ])
            
            $this->add([
                "colum"    => ,
                "type"     =>$this->intval(),
                "relation" =>,
            ])
            
            $this->add([
                "colum"    => ,
                "type"     =>$this->one_to_one(),
                "relation" =>Array,
            ])
            
            $this->add([
                "colum"    => ,
                "type"     =>$this->varchar(),
                "relation" =>,
            ])
            
            $this->add([
                "colum"    => relation_key,
                "type"     =>$this->intval(),
                "relation" =>true,
            ])
            
            $this->add([
                "colum"    => relation,
                "type"     =>$this->one_to_one(),
                "relation" =>true,
            ])
            
            $this->add([
                "colum"    => erg,
                "type"     =>$this->varchar(),
                "relation" =>true,
            ])
            
        }
        }