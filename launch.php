<?
    spl_autoload_register(function ($class) {
        $pages = $_SERVER['DOCUMENT_ROOT'] . '/pages/'. $class . '.php';
        $actions = $_SERVER['DOCUMENT_ROOT'] . '/actions/'. $class . '.php';
        $script = $_SERVER['DOCUMENT_ROOT'] . '/js/'. lcfirst($class) . '.js';

        if (file_exists($script)) {
            $GLOBALS['script'] = '/js/' . lcfirst($class) . '.js';
        }

        if (!file_exists($pages)) {
            throw new Exception('Error');
        }
        if (file_exists($actions)) {
            require($actions);
        }
        require($pages);
    });