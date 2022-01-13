<?

Class Router
{

    public function __construct($url)
    {
        global $content;
        global $css;
        global $js;
        global $jsx;
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
                $js = $this->getJS($class, $method);
                $css = $this->getCss($class);
                $jsx = $this->getJSX($class, $method);
                if (class_exists($class)) {
                    $instance = new $class($body);
                } else {
                    throw new Exception();
                }
                if (method_exists($instance, $method)) {
                    ob_start();
                    $content = call_user_func([$instance, $method], $body);
                    var_dump($content);
                    ob_end_clean();
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
        switch ($arr[0]) {
            case "api":
                break;
            default:
            array_unshift($arr, "_");
            break;
        }
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
        $dirJS = $_SERVER['DOCUMENT_ROOT'] . '/js/'. $class.'_'.$method. '.js';
        if (file_exists($dirJS)) {
            return '/js/' . $class.'_'.$method . '.js';
        }
    }
    private function getJSX($class, $method)
    {
        $dirJSX = $_SERVER['DOCUMENT_ROOT'] . '/js/'. $class.'_'.$method. '.jsx';
        if (file_exists($dirJSX)) {
            return '/js/' . $class.'_'.$method . '.jsx';
        }
    }
    private function getCss($file)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/css/'. $file . '.css';
        if (file_exists($dir)) {
            return '/css/' . $file . '.css';
        }
    }
}
?>