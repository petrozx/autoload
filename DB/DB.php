<?

class DB
{

    public function __construct() {
        $connect = new mysqli(base_host, user_base, password_base, password_name);
        if ($connect->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $connect->connect_error);
        }
        $connect->set_charset('utf8mb4');
        return $connect;
    }


    public function getRows() {
        $query = $connect->query("SELECT * FROM users");
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        return $arr;
        }
    }

}