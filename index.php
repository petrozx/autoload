<?
require_once('launch.php');
require_once('routing/router.php');
require_once('DB/DBCon.php');
try {
    new Router(
        $_SERVER['REQUEST_URI']
    );
} catch (Exception $e) {
    echo 'Поймано исключение: ',  $e->getMessage(), "\n";
}
require('content/main.php');
?>