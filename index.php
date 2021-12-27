<?
session_start();
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');
$res = new DBCon('petr1', 'petr1', 'petroz1inbox');
$res->save();
new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>

