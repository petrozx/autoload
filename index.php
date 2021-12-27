<?
session_start();
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');
$res = new DBCon();
$returnID = $res->getUsers();
echo '<pre>'.print_r($returnID, true).'</pre>';
new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>

