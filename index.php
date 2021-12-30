<?
session_start();
empty($_SESSION['name'])?:$_SESSION['name'] = 'Гость';
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DBCon.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/launch.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/routing/router.php');

try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    $GLOBALS['content'] = $e->getMessage();
}
require($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');
?>