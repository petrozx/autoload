<?
session_start();
define('ACCESS', ['petroz.myjino.ru']);
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DBCon.php');
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');
try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    $GLOBALS['content'] = $e->getMessage();
}
require('content/main.php');
?>
<script>const from = <?=ACCESS ?></script>