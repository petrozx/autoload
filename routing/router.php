<?

Class Router
{

    public function __construct($url)
    {
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = $class?:'Index';
        $method = $method?:'index';
        try {
            if ($action == 'api') {
                $this->getFileWithFunc($class);
                if (function_exists($method)){
                    call_user_func($method);
                } else {
                    throw new Exception();
                }
            } else {
                $class = ucfirst($class);
                $instance = new $class($body);
                if (method_exists($instance, $method)) {
                    $GLOBALS['content'] = call_user_func([$instance, $method], $body);
                    var_dump($GLOBALS['content']);
                }
            }
        } catch (Exception $e) {
            throw new Exception('Запрашиваемый ресурс отсутствует');
        }
    }

    private function parseURL($url)
    {
        $string = trim(str_replace('/', " ", $url));
        $arr = explode(" ", $string);
        $arr[0]!=='api' ? array_unshift($arr, "_") : $arr;
        return $arr;
    }

    private function getFileWithFunc($file)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/actions/".$file.".php";
        if (file_exists($dir)) {
            include_once($dir);
        }
    }
}
?>