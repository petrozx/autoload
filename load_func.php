<?
$dir = "~/actions/";
        $catalog = opendir($dir);
        while ($filename = readdir($catalog )) // перебираем наш каталог
        {
            var_dump('test');
            $filename = $dir."".$filename;
            include_once($filename); // один раз подрубаем, чтоб не повторяться
        }