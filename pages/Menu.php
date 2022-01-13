<?

class Menu
{
    public function list() {?>
        <ul>
            <li>Плов</li>
            <li>Борщ</li>
            <li>Щи</li>
            <li>Аджика</li>
        </ul>
        <?return ob_get_contents();
    }

    public function index() {?>
        <div>
            <h1>привет это буфер</h1>
        </div>
    <?return ob_get_length();
    }
}