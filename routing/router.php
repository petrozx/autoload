<?

Class Router
{
    public function __construct($url)
    {
        global $content;
        global $css;
        global $js;
        global $jsx;
        global $arResult;
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = $class?:'index';
        $method = $method?:'index';
        try {
            if ($action == 'api') {
                $this->getFileWithFunc($class);
                if (function_exists($method)){
                    call_user_func($method);
                } else {
                    throw new Exception();
                }
            } else if ($action == '_') {
                $this->getModules($class);
                $js = $this->getJS($class, $method);
                $css = $this->getCss($class);
                $jsx = $this->getJSX($class, $method);
                $instance = new $class($class);
                    if(is_callable([$instance, $method])) {
                        $arResult = call_user_func([$instance, $method], $body);
                        ob_start();
                        call_user_func_array(['Router','getComponents'], [$class, $method, $arResult]);
                        $content = ob_get_clean();
                    } else {
                        throw new Exception();
                    }
            } else {
                throw new Exception();
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
            require_once($dir);
        }
    }
    private function getJS($class, $method)
    {
        $dirJS = ROOT."/components/{$class}/{$method}/js/script.js";
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
    private function getModules($class)
    {
        $modules = ROOT."/modules/{$class}";
        if (file_exists($modules)) {
            require_once($modules."/".CLASS_COMPONENT);
        }
    }
    private function getComponents($class, $method, $arResult)
    {
        $component = ROOT."/components/{$class}/{$method}";
        if (file_exists($component)) {
            require_once($component."/template.php");
        }
    }
}
?>