<?

    spl_autoload_register(function ($class) {
        $file = $_SERVER['DOCUMENT_ROOT'].'/pages/'. $class.'.php';
        $script = $_SERVER['DOCUMENT_ROOT'].'/js/'. $class.'.js';

        if (file_exists($file)) {
            $GLOBALS['script'] = $script;
        }

        if (!file_exists($file)) {
            throw new Exception('Error');
        }

        require($file);
    });
