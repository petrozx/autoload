<?php

class Index
{
    public function __construct() {
        $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        $db = new DB();
        $retuslt = $db->deleteTable('blog');
        var_dump($retuslt);
    }

}