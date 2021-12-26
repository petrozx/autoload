<?
session_start();
require_once('launch.php');
require_once('routing/router.php');
unset($_SESSION['script']);
new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>

