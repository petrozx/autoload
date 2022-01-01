<?
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/launch.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/routing/router.php');

try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    $GLOBALS['content'] = $e->getMessage();
}
var_dump($content);
var_dump($GLOBALS['content']);

require($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');
?>