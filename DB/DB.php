<?

class DB
{

    public $BD;
    public $table;

    public function __construct($table) {
        $this->$table = $table;
        $this->BD = new mysqli(base_host, user_base, password_base, password_name);
        if ($this->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $this->connect_error);
        }
        // $this->set_charset('utf8mb4');
        return $this;
    }

    public function getRows() {
        $query = $this->query("SELECT * FROM ".$table."");
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        return $arr;
        }
    }

}