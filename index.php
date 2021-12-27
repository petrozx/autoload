<?
session_start();
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');
$res = new DBCon();
$returnID = $res->getUsers();
var_dump($returnID);
new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>

