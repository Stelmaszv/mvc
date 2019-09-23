<?php
namespace helpels;
class math{
    static function procentCount($numbers,$number){
        $all=array_sum($numbers);
        $elment=$numbers[$number];
        $prcent=$elment*100/$all;
        return $prcent;
    }
}