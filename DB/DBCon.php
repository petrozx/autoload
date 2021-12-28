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
        $hash = $this->encode($name, $password, $email);
        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO users(user) VALUES (?)");
        $stmt->bind_param("s", $hash);
        $stmt->execute();
        $result = $GLOBALS['mysqli']->insert_id;
        return $result;
    }

    public function getUsers() {
        $query = $GLOBALS['mysqli']->query("SELECT * FROM users");
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function close() {
        $GLOBALS['mysqli']->close();
    }

    private function encode($name, $pass, $email) :array {
        $num = substr(random_int(0,PHP_INT_MAX),0,5);
        $str = $name.':'.$pass.':'.$email;
        $arrFromStr = str_split($str);
        $arrResult = '';
        foreach($arrFromStr as $chr) {
            $numOfChar = ord($chr);
            $arrResult .= 'x'.($numOfChar + $num);
        }
        $arrResult = base64_encode($arrResult);
        return ['hash' => $arrResult, 'num' => $num];
    }
}
