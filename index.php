<?
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');

new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>