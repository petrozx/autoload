<?php

class Index
{
    public function __construct() {
        $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        $db = new DB();
        $db->createTable('blog', ['title', 'content']);
    }

}