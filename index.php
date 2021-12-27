<?
header('Access-Control-Allow-Origin: http://petroz.myjino.ru/');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Max-Age: 10000');
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');

new Router(
    $_SERVER['REQUEST_URI']
);

require('content/main.php');
?>