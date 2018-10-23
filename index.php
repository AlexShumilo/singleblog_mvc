<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.08.2018
 * Time: 10:45
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once (ROOT . '/components/Router.php');
require_once (ROOT . '/components/Db.php');
require_once (ROOT . '/components/View.php');

$router = new Router();
$router->run();
?>