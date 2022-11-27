<?
//header("Cache-control: public");
//header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*24) . " GMT");
//session_start();
//require_once($_SERVER['DOCUMENT_ROOT'] . '/routing/router.php');
//
//try {
//    new Router(
//        $_SERVER['REQUEST_URI']
//    );
//} catch (Exception $e) {
//    $content = $e->getMessage();
//}
//$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//if (empty($_SESSION['auth']) && $url !== 'https://'.$_SERVER['HTTP_HOST'].'/login/register') {
//    header('Location: https://'.$_SERVER['HTTP_HOST'].'/login/register');
//}
//require_once($_SERVER['DOCUMENT_ROOT'] . '/content/main.php');

const DB_HOST = "localhost";
const DB_USER = "j88864691";
const DB_PASS = "198719pvPV";
const DB_NAME = "j88864691";
const CLASS_COMPONENT = "class.php";
$charset = 'utf8';

class User
{
    private $id;
    private $login;
    private $date_create;

    public function getDateCreate() {
        echo $this->date_create;
    }
}

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $opt);
}
catch (PDOException $e) {
        die('Подключение не удалось: ' . $e->getMessage());
    }

    $pdo->beginTransaction();
    $sth = $pdo->query("select * from user where id = 2");
    $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $sth->fetch();
    $user->getDateCreate();
