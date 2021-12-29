<?

    spl_autoload_register(function ($class) {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/pages/'. $class . '.php';
        $script = $_SERVER['DOCUMENT_ROOT'] . '/js/'. lcfirst($class) . '.js';

        if (file_exists($script)) {
            $GLOBALS['script'] = lcfirst($class) . '.js';
        }

        if (!file_exists($file)) {
            throw new Exception('Error');
        }

        require($file);
    });
