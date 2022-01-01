<?php

class Menu 
{
    public function list() {
        $GLOBALS['content'] = '
        <ul>
            <li>Плов</li>
            <li>Борщ</li>
            <li>Щи</li>
            <li>Аджика</li>
        </ul>
        ';
    }
    public function index(){
        $GLOBALS['content'] = Menu::content();
    }

    static function content() {
        return '
        <div class="fluger">
            <h1>Привет это новый способ</h1>
        </div>
        ';
    }
}