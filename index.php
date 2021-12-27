<?
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');

define('MyConst', TRUE);

new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>