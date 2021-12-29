<?
session_start();

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
require($_SERVER['DOCUMENT_ROOT'].'/content/main.php');
?>