<?
    spl_autoload_register(function ($class) {
        $other = $class;
        $pages = $_SERVER['DOCUMENT_ROOT'] . '/pages/'. ucfirst($class) . '.php';
        $script = $_SERVER['DOCUMENT_ROOT'] . '/js/'. $other . '.js';
        $css = $_SERVER['DOCUMENT_ROOT'] . '/css/'. $other . '.css';

        if (file_exists($script)) {
            $GLOBALS['script'] = '/js/' . $other . '.js';
        }
        if (file_exists($css)) {
            $GLOBALS['css'] = '/css/' . $other . '.css';
        }

        if (!file_exists($pages)) {
            throw new Exception('Error');
        }
        require($pages);
    });