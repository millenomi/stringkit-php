<?php

if (defined('kSKStringKitHome')) return;

define('kSKStringKitHome', realpath(dirname(__FILE__)));

function SKAutoloadClass($class) {
	require_once kSKStringKitHome . DIRECTORY_SEPARATOR . "$class.php";
}

require kSKStringKitHome . DIRECTORY_SEPARATOR . 'SKFunctions.php';

spl_autoload_register('SKAutoloadClass');
