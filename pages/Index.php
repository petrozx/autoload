<?php

class Index
{
    public function __construct() {
        $GLOBALS['content'] = 'Вы нахоитесь на главной странице';
        $db = DB::deleteTable('blog');
        var_dump($db);
    }

}