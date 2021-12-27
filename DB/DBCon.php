<?
class DBCon
{
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli('mysql.petroz.myjino.ru', 'petroz', '198719pv', 'petroz');
        if ($mysqli->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $mysqli->connect_error);
        }
        $mysqli->set_charset('utf8mb4');
    }

    public function save($name, $password, $email) {
        $result = $mysqli->query("INSERT INTO `users`(`name`, `password`, `email`) VALUES ($name,$password,$email)");
        $mysqli->close();
    }
}
