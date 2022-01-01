<?php
class Menu 
{
    public function list(){
        return '
        <ul>
            <li>Плов</li>
            <li>Борщ</li>
            <li>Щи</li>
            <li>Аджика</li>
        </ul>
        ';
    }
    public function index(){
        return Menu::content();
    }

    static function content() {
        return '
        <div class="fluger">
            <h1>Привет это новый способ</h1>
        </div>
        ';
    }
}