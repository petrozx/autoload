<?
$dir = $_SERVER['DOCUMENT_ROOT'] . "/actions/";
        $catalog = opendir($dir);
        while ($filename = readdir($catalog )) // перебираем наш каталог
        {
            $filename = $dir."".$filename;
            var_dump($filename);
            include_once($filename); // один раз подрубаем, чтоб не повторяться
        }
        closedir($catalog);