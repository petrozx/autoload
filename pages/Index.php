<?php

class Index
{
    public function __construct() {
        if ($_SESSION['auth']['role']==='9') {
            $GLOBALS['content'] = 'Вы администратор';
        } else {
            $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        }
    }

}