<?php
//load config
require_once 'config/config.php';

//Autoload core libraries
spl_autoload_register(function($className){
  require_once 'libraries/' . $className . '.php';
  // require_once 'libraries/Database.php';
});