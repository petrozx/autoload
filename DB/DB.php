<?

class DB
{

    private $BD;
    public $table;

    public function __construct($table) {
        $this->$table = $table;
        $this::$BD = new mysqli(base_host, user_base, password_base, password_name);
        if ($this::$BD->connect_errno) {
            throw new RuntimeException('ошибка соединения с БД: ' . $this::$BD->connect_error);
        }
        $this::$BD->set_charset('utf8mb4');
        return $this;
    }

    public function getRows() {
        $query = $this::$BD->query("SELECT * FROM ".$this->$table."");
        while ($row = $query->fetch_row()) {
            $arr[] = $row;
        return $arr;
        }
    }

}