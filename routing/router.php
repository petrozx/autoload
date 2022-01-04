<?

Class Router
{

    public function __construct($url)
    {
        global $content;
        global $css;
        global $js;
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
                $this->getJS($class, $method);
                $this->getCss($class);
                $instance = new $class($body);
                if (method_exists($instance, $method)) {
                    $content = call_user_func([$instance, $method], $body);
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
    private function getJS($class, $method)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/js/'. $class.'_'.$method. '.js';
        if (file_exists($dir)) {
            $js = '/js/' . $class.'_'.$method . '.js';
        }
    }
    private function getCss($file)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/css/'. $file . '.css';
        if (file_exists($dir)) {
            $css = '/css/' . $file . '.css';
        }
    }
}
?>