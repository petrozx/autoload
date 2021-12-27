<?
class DBCon
{
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $GLOBALS['mysqli'] = new mysqli('mysql.petroz.myjino.ru', 'petroz', '198719pv', 'petroz');
        if ($GLOBALS['mysqli']->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $GLOBALS['mysqli']->connect_error);
        }
        $GLOBALS['mysqli']->set_charset('utf8mb4');
    }

    public function save($name, $password, $email) {
        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO users(nameUser, passwordUser, emailUser) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password, $email);
        $req = $stmt->execute();
        $id = $req->insert_id();
        return $id;
    }

    public function getUsers() {
        $stmt = $GLOBALS['mysqli']->prepare("SELECT * FROM users");
        $stmt->execute();
    }

    public function close() {
        $GLOBALS['mysqli']->close();
    }
}
