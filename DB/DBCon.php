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
        $hash = $this->encode($name, $password, $email);
        $bind = $this->saveBind($hash['num']);
        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO users(user, num) VALUES (?, ?)");
        $stmt->bind_param("si", $hash['hash'], $bind);
        $stmt->execute();
        $result = $GLOBALS['mysqli']->insert_id;
        $stmt->close();
        return $result;
    }

    public function getUsers() {
        $query = $GLOBALS['mysqli']->query("SELECT * FROM users");
        while ($row = $query->fetch_row()) {
            $arr[] = array(
                'hash' => $row[1],
                'num'  => $row[2]
            );
        }
        foreach($arr as $usr) {
            $take = $this->selecttBind($usr['num']);
            $res = $this->decode($usr['hash'], $take['bind']);
            $arrUsers[] = $res;
        }
        return $arrUsers;
    }

    public function close() {
        $GLOBALS['mysqli']->close();
    }

    private function saveBind($num) {
        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO bindings(bind) VALUES (?)");
        $stmt->bind_param("i", $num);
        $stmt->execute();
        $result = $GLOBALS['mysqli']->insert_id;
        $stmt->close();
        return $result;
    }

    private function selecttBind($id) {
        $stmt = $GLOBALS['mysqli']->prepare("SELECT * FROM bindings WHERE id = (?)");
        $stmt->bind_param("i", $id);
        $stmt->bind_result($idB, $bind);
        $stmt->execute();
        while ($stmt->fetch()){
            $result = array(
                'id'   => $idB,
                'bind' => $bind
            );
        }
        $stmt->close();
        return $result;
    }

    private function encode($name, $pass, $email) {
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

    private function decode($hash, $num) {
    $string = base64_decode($hash);
    $string = explode('x', $string);
    unset($string[0]);

    foreach($string as $el) {
        $ch = $el-$num;
        $stringi[] = chr($ch);
    }

    $stringi = explode(':', implode($stringi));
    $user[$stringi[2]] = array(
        'name' => $stringi[0],
        'pass' => $stringi[1]
    );
    
    return $user;
    }
}
