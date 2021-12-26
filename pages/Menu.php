<?php
class Menu 
{
    public function list(){
        $_SESSION['message'] = '
        <ul>
            <li>Плов</li>
            <li>Борщ</li>
            <li>Щи</li>
            <li>Аджика</li>
        </ul>
        ';
    }
    public function index(){
        $_SESSION['message'] = 'индексный метод';
    }
}