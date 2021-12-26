<?

    spl_autoload_register(function ($class) {
        $file = str_replace('\\', '/', (__DIR__.'/pages/'. $class.'.php'));

        if (!file_exists($file)) {
            throw new Exception('Error');
        }
        require('pages/'. $class.'.php');
    });
