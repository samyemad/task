<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//for me , without this setting its not showing error // so will comment if not needed ,dont remove
require('./autoloader.php');
use Core\SimpleKernel;

// call the controllers using
// domain(localhost)/app_name/index.php/Controller_name/function/args..../
$kernel=new SimpleKernel();
$kernel->init();
