<?
header("Cache-control: public");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*24) . " GMT");
session_start();
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (empty($_SESSION['auth']) && $url !== 'https://'.$_SERVER['HTTP_HOST'].'/login/register') {
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/login/register');
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/routing/router.php');

try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    $content = $e->getMessage();
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');
