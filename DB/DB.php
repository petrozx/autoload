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
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        return $arr;
        }
    }

    public function saveRows($arr) {
        $stmt = self::$connect->prepare("INSERT INTO users VALUES (...?)");
        var_dump(...$arr);
        $stmt->bind_param("sss", ...$arr);
        $stmt->execute();
        $result = self::$connect->insert_id;
        $stmt->close();
        return $result;
    }

}