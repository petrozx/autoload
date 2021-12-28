<?

Class Router
{

    public function __construct($url)
    {
        [$class, $method, $name] = $this->parseURL($url);
        $class = ucfirst($class)?:'Index';
        $method = $method?:'index';
        $file = $_SERVER['DOCUMENT_ROOT'].'/pages/'. $class.'.php';
        var_dump(is_callable([$class, $method], true, $callable_name));
        if (!file_exists($file) || !is_callable([$class, $method])){
            $GLOBALS['content'] = 'Запрашиваемой страницы не существует';
        } else {
            $instance = new $class($name);
            call_user_func([$instance, $method], $name);
        }
    }

    private function parseURL($url)
    {
        $result = trim(str_replace('/', " ", $url));
        $result = explode(" ", $result);
        return $result;
    }

}
?>