<?php

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
    public function index(){
    ob_start();
    ?>
        <div>
            <h1>привет это буфер</h1>
        </div>
    <?
    $out1 = ob_get_contents();
    ob_end_clean();
    return $out1;
    }
}