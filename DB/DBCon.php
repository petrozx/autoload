<?

class DBCon
{
    public function __construct() {
        $mysqli = new mysqli('mysql.petroz.myjino.ru', 'petroz', '198719pv', 'petroz');
        $mysqli->set_charset('utf8mb4');
        printf("Успешно... %s\n", $mysqli->host_info);
    }
}
$conn = new DBCon();