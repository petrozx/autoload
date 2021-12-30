<?
    spl_autoload_register(function ($class) {
        $pages = $_SERVER['DOCUMENT_ROOT'] . '/pages/'. $class . '.php';
        $script = $_SERVER['DOCUMENT_ROOT'] . '/js/'. lcfirst($class) . '.js';

        if (file_exists($script)) {
            $GLOBALS['script'] = '/js/' . lcfirst($class) . '.js';
        }

        if (!file_exists($pages)) {
            throw new Exception('Error');
        }
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/actions";
        $catalog = opendir($dir);
        while ($filename = readdir($catalog )) // перебираем наш каталог
        {
            var_dump('test');
            $filename = $dir."/".$filename;
            include_once($filename); // один раз подрубаем, чтоб не повторяться
        }

        closedir($catalog);
        require($pages);
    });