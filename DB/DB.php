<?
class DB
{
    public static $connect;
    public static $table;

    public function __construct($table) {
        $connect = new mysqli(base_host, user_base, password_base, password_name);
        if ($connect->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $connect->connect_error);
        }
        $connect->set_charset('utf8mb4');
        self::$connect = $connect;
        self::$table = $table;
    }

    public function getRows() {
        $query = self::$connect->query("SELECT * FROM ".self::$table);
        while ($row = $query->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    static function getColumns() {
        $query = self::$connect->query("SHOW COLUMNS FROM ".self::$table);
        while ($row = $query->fetch_assoc()) {
            $names[] = $row['Field'];
        }
        return $names;
    }

    public function saveRows($arr) {
        $names = $this->getColumns();
        $deleteID = array_search('id',$names);
        unset($names[$deleteID]);
        $code = str_repeat('s',count($names));
        $prepareNames = array_map(function($e){ return $e."=?"; }, $names);
        $queryNames = implode(",", $prepareNames);
        $stmt = self::$connect->prepare("INSERT INTO ".self::$table." SET ".$queryNames);
        $stmt->bind_param($code, ...$arr);
        $stmt->execute();
        $result = self::$connect->insert_id;
        $stmt->close();
        return $result;
    }

    public function close_connection() {
        self::$connect->close();
    }

}