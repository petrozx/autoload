<?php

class Index
{
    public function __construct() {
        $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        $db = new DB('users');
        $retuslt = $db->deleteRaw(65);
        var_dump($retuslt);
    }

}