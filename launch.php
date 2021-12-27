<?

    spl_autoload_register(function ($class) {
        $file = $_SERVER['DOCUMENT_ROOT'].'/pages/'. $class.'.php';

        if (!file_exists($file)) {
            throw new Exception('Error');
        }
        require('pages/'. $class.'.php');
    });
