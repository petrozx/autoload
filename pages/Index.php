<?php

class Index
{
    public function index() {
        if ($_SESSION['auth']['role']==='9') {
            return 'Вы администратор';
        } else {
            return '<div id="root"></div>';
        }
    }

}