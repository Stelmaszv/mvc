<?php
namespace App;
abstract class apiRequest{
    use \singletonCreate;
    abstract  function show();
}