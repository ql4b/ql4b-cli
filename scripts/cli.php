<?php
/**
 * cli.php 
 *
 * This program is free software: you can redistribute it and/or modify it under the 
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or any later version.
 *
 * @author Carlo D'Ambrosio <carlo@ql4b.net>
 * @copyright Copyright (c) 2011, Carlo D'Ambrosio
 * @license http://www.gnu.org/licenses/gpl.txt
 * @version $Id$
 *
 */

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