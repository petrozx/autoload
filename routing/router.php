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
                $componets = ROOT."/component/";
                $dir = scandir($componets);
                if (in_array($class, $dir)) {
                    var_dump($dir);
                    require_once($componets.$class.'/'.CLASS_COMPONENT);
                    $instance = new $class($class);
                    $content = call_user_func([$instance, $method], $body);
                    if (in_array('template', $dir)) {
                        require_once($componets.$class.'/template/'.TEMPLATE);
                    } else {
                        throw new Exception();
                    }
                } else {
                    throw new Exception();
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