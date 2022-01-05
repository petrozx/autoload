<?
session_start();
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
if (!empty($_SESSION['auth']))header('Location: https://petroz.ru/login/register');

require($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');
?>