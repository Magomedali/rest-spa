<?php

use Zend\ServiceManager\ServiceManager;

if(defined('APP_TEST_MODE') && APP_TEST_MODE) {
	$config = require __DIR__ . '/config-test.php';
} else {
	$config = require __DIR__ . '/config.php';
}


$container = new ServiceManager($config['dependencies']);

$container->setService('config', $config);

return $container;