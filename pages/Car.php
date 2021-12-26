<?

class Car
{
    public $name;

    public function __construct($name) {
        $this->$name = $name;
    }

    public function mycar($name) {
        $_SESSION['message'] = '<div id="root"></div>';
        $_SESSION['script'] = '/js/script.jsx';

    }

}
?>
