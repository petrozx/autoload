<?
class DBCon
{
    public function __construct($name, $password, $email) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli('mysql.petroz.myjino.ru', 'petroz', '198719pv', 'petroz');
        if ($conn->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $conn->connect_error);
        }
        $conn->set_charset('utf8mb4');
        $result = $conn->query("INSERT INTO `users`(`name`, `password`, `email`) VALUES ($name,$password,$email)");
        $conn->close();
    }

    public function save() {
    }
}
