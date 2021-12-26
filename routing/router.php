<?

Class Router
{

    public function __construct($url)
    {
        [$class,$method, $name] = $this->parseURL($url);
        var_dump(__dir__);
        $method = $method?:'index';
        $file = 'pages/'. $class.'.php';
        if ($url=='/') {
            $_SESSION['message'] = 'Главная страница';
        } else {
            if (!file_exists($file) || !is_callable([$class, $method])){
                $_SESSION['message'] = 'Запрашиваемой страницы не существует';
            } else {
                $instance = new $class($name);
                call_user_func([$instance, $method], $name);
            }
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