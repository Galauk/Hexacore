<?php
header('Content-Type: text/html; charset=utf-8');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require 'core'.DS.'AutoLoad.php';

$AutoLoad = new AutoLoad();

spl_autoload_register(array($AutoLoad, 'core'));

use Controller as Controller;

$controller = new Controller();

if (!empty($_GET['action'])){
	$controller->{$_GET['action']}();
}

?>