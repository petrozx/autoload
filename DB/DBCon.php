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
    public function saveUser($name, $password, $email) {
        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO users(name, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, password_hash($password, PASSWORD_DEFAULT), $email);
        $stmt->execute();
        $result = $GLOBALS['mysqli']->insert_id;
        $stmt->close();
        return $result;
    }
    public function getUsers() {
        $query = $GLOBALS['mysqli']->query("SELECT * FROM users");
        while ($row = $query->fetch_row()) {
            $arr[] = array(
                'email'    => $row[3],
                'id'       => $row[0],
                'name'     => $row[1],
                'password' => $row[2],
                'role'     => $row[4]
                );
        }
        return $arr;
    }

    public function findUser($email) {
        $stmt = $GLOBALS['mysqli']->prepare("SELECT * FROM users WHERE email = (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->close();
        return $result;
    }

    public function getAll($table) {
        $query = $GLOBALS['mysqli']->query("SELECT * FROM $table");
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        return $arr;
        }
    }
    // public function getAll($table) {
    //     $stmt = $GLOBALS['mysqli']->prepare("SELECT * FROM (?)");
    //     $stmt->bind_param("s", $table);
    //     $stmt->execute();
    //     while ($row = $stmt->fetch()) {
    //         $arr[] = $row;
    //     }
    //     $stmt->close();
    //     return $arr;
    // }

    public function close() {
        $GLOBALS['mysqli']->close();
    }
}
