<?

class Menu 
{
    public function list() {
        return '
        <ul>
            <li>Плов</li>
            <li>Борщ</li>
            <li>Щи</li>
            <li>Аджика</li>
        </ul>
        ';
    }
    public function index() {
        return?>
        <div>
            <h1>привет это буфер</h1>
        </div>
    <?}
}