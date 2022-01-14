<?

Class Router
{

    public function __construct($url)
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
        global $class;
        global $method;
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = $class?:'index';
        $method = $method?:'index';
        try {
            switch ($action) {
                case 'api':
                    $this->getFileWithFunc($class);
                    if (function_exists($method)){
                        call_user_func($method);
                    } else {
                        throw new Exception();
                    }
                    break;
                case 'js':
                    $this->getJS($class, $method);
                    break;
                case '_':
                    $this->getModules($class);
                    $css = $this->getCSS($class, $method);
                    $instance = new $class($class);
                        if(is_callable([$instance, $method])) {
                            $arResult = call_user_func([$instance, $method], $body);
                            ob_start();
                            call_user_func_array(['Router','getComponents'], [$class, $method, $arResult]);
                            $content = ob_get_clean();
                        } else {
                            throw new Exception();
                        }
                    break;
                default:
                    throw new Exception();
                    break;
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
            case "js":
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
        echo "(async()=>{";
        echo file_get_contents(ROOT."/js/script.js");
        echo file_get_contents(ROOT."/components/".$class."/".$method."/js/script.js");
        echo "})()";
        exit();
    }
    private function getCss($file)
    {
        $dir = ROOT . '/css/'. $file . '.css';
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