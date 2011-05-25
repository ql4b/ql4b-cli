<?php

/* Define path to application directory */
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

/* check for app environment config */
$i = array_search('-e', $_SERVER['argv']);
if (!$i) {
    $i = array_search('--environment', $_SERVER['argv']);
}
if ($i) {
    define('APPLICATION_ENV', $_SERVER['argv'][$i+1]);
}
if (!defined('APPLICATION_ENV')) {
    if (getenv('APPLICATION_ENV')) {
        $env = getenv('APPLICATION_ENV');
    } else {
        $env = 'production';
    }
    define('APPLICATION_ENV', $env);
}

/** Zend_Application */
require_once 'Zend/Application.php';

/* Create application, bootstrap, and run */
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap();
$application->run();

?>