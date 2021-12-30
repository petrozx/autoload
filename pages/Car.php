<?

class Car
{
    public $name;

    public function __construct($name) {
        $this->$name = $name;
    }

    public function mycar($name) {
        $GLOBALS['content'] = '<div id="car"></div>';
    }

}
?>
