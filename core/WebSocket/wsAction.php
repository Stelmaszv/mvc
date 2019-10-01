<?php
namespace CoreWebSocket;
abstract class wsAction{
    abstract protected function execute($clients,$msg,$from);
}