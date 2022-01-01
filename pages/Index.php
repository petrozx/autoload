<?php

class Index
{
    public function __construct() {
        if ($_SESSION['auth']['role']==='9') {
            return 'Вы администратор';
        } else {
            return 'Вы нахоитесь на главной странице';
        }
    }

}