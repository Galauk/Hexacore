<?php
header('Content-Type: text/html; charset=utf-8');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require 'library'.DS.'Erik'.DS.'core'.DS.'AutoLoad.php';

$AutoLoad = new AutoLoad();

spl_autoload_register(array($AutoLoad, 'core'));

use ErikCoreController as Controller;

$controller = new Controller();
?>