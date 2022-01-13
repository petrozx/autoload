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
        <?return ob_end_flush();
    }

    public function index() {?>
        <div>
            <h1>привет это буфер</h1>
        </div>
    <?return ob_end_flush();
    }
}