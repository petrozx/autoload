<?
/**
 * Основной класс для работы с БД
 */
class DB
{
    public static $connect;
    private static $table;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($connect->connect_errno) {
            throw new RuntimeException('Ошибка соединения с БД: ' . $connect->connect_error);
        }
        $connect->set_charset('utf8mb4');
        self::$connect = $connect;
    }

    /**
     * Метод задает название таблицы
     */
    public function setTable($table)
    {
        self::$table = $table;
    }

    public function getRows(): array
    {
        $query = self::$connect->query("SELECT * FROM ".self::$table);
        while ($row = $query->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr?:[];
    }

    public function getFilterRows($filter): array
    {
        $query = self::$connect->query("SELECT * FROM ".self::$table." WHERE ". $filter);
        while ($row = $query->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr?:[];
    }

    private function getColumns(): array
    {
        $names = [];
        $query = self::$connect->query("SHOW COLUMNS FROM ".self::$table);
        while ($row = $query->fetch_assoc()) {
            $names[] = $row['Field'];
        }
        return $names;
    }

    public function saveRows($arr)
    {
        $names = $this->getColumns();
        $deleteID = array_search('id', $names);
        unset($names[$deleteID]);
        $code = '';
        foreach($names as $name) {
            switch (gettype($name)) {
                case "string":
                    $code .= 's';
                    break;
                case "integer":
                    $code .= 'i';
                    break;
            }
        }
        $prepareNames = array_map(function($e){ return $e."=?"; }, $names);
        $queryNames = implode(",", $prepareNames);
        $stmt = self::$connect->prepare("INSERT INTO ".self::$table." SET ".$queryNames);
        $stmt->bind_param($code, ...$arr);
        $stmt->execute();
        $result = self::$connect->insert_id;
        $stmt->close();
        return $result;
    }

    public function isOnline($user)
    {
        return self::$connect->query("UPDATE `users` SET `date_update` = ".time()." WHERE `users`.`id` = ".$user);
    }

    public function createTable($columns)
    {
        $prepareNames = array_map(function($e){ return $e." TEXT"; }, $columns);
        $prepareNames = implode(",", $prepareNames);
        $query = self::$connect->query("CREATE TABLE IF NOT EXISTS ". self::$table ." (id INTEGER AUTO_INCREMENT PRIMARY KEY, ". $prepareNames .")");
    }

    public function deleteTable($name)
    {
        return self::$connect->query("DROP TABLE ".$name);
    }

    public function deleteRaw($id)
    {
        return self::$connect->query("DELETE FROM ".self::$table." WHERE `users`.`id` = ".$id);
    }

    /**
     * @throws Exception
     */
    public function updateRaw($id, $fields) {
        try {
            $code = '';
            foreach($fields as $field) {
                switch (gettype($field)) {
                    case "string":
                        $code .= 's';
                        break;
                    case "integer":
                        $code .= 'i';
                        break;
                }
            }
            $arrKeys = array_keys($fields);
            $prepareFieldsKeys = array_map(function($e){return $e."=?";}, $arrKeys);
            $prepareFieldsKeys = implode(', ', $prepareFieldsKeys);
            $stmt = self::$connect->prepare("UPDATE ".self::$table." SET {$prepareFieldsKeys} WHERE id=".$id);
            $prepareFields = array_values($fields);
            $stmt->bind_param($code, ...$prepareFields);
            return self::$connect->insert_id;
        } catch(Exception $e) {
            throw new Exception('Ошибка обновления');
        } finally {
            $stmt->execute();
        }
    }

    public function checkTable($name)
    {
        $query = self::$connect->query("CHECK TABLE petroz.".$name);
        $row = $query->fetch_assoc();
        return $row['Msg_text'];
    }

    public function close_connection()
    {
        self::$connect->close();
    }

    public function chatsWithMe($id)
    {
        $query = self::$connect->query("SELECT users.id, users.name FROM `users` INNER JOIN chat ON
        what_a_chat=users.id OR chat.author=users.id WHERE what_a_chat={$id} AND users.id!={$id} OR chat.author={$id} AND users.id!={$id}");
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        if (!empty($rows)) {
            $result = $this->array_unique_key($rows, 'id');
        } else {
            $result = false;
        }
            return $result;
    }

    private function array_unique_key($array, $key): array
    {
        $tmp = $key_array = array();
        $i = 0;
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $tmp[$i] = $val;
            }
            $i++;
        }
        return $tmp;
    }

    public function has_newMessage($id): bool
    {
        $query = self::$connect->query("SELECT * FROM `users` INNER JOIN chat ON what_a_chat=users.id OR chat.author=users.id WHERE chat.is_read=0 AND chat.what_a_chat=".$id);
        $res = $query->fetch_assoc();
        if (empty($res))
            return false;
        else
            return true;
    }
} 