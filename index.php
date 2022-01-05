<?
session_start();
header('Location: http://'.$_SERVER['HTTP_HOST'].'/login/register');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/launch.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/routing/router.php');

try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    $content = $e->getMessage();
}
require($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');
?>