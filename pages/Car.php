<?

class Car
{
    public $name;

    public function __construct($name) {
        $this->$name = $name;
    }

    public function mycar($name) {
        return '<div id="car"></div>';
    }

}
?>
