<?

    spl_autoload_register(function ($class) {
        $file = 'http://petroz.myjino.ru/pages/'. $class.'.php';

        if (!file_exists($file)) {
            throw new Exception('Error');
        }
        require('pages/'. $class.'.php');
    });
