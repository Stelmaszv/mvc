<?php
namespace App;
abstract class wsAction{
    abstract protected function execute($clients,$msg,$from);
}