<?php

class Index
{
    public function __construct() {
        $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        if ($_SESSION['auth']['role']===9) {
        $GLOBALS['content'] = 'Вы администратор';
        }
    }

}