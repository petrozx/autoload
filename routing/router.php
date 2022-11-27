<?

Class Router
{

    /**
     * @throws Exception
     */
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
//                        throw new Exception();
                    }
                    break;
                case 'js':
                    $this->getJS($class, $method);
                    break;
                case 'css':
                    $this->getCSS($class);
                    break;
                case '_':
                    $this->getModules($class);
                    if (class_exists($class)) {
                        $instance = new $class($class);
                            if(is_callable([$instance, $method])) {
                                $arResult = call_user_func([$instance, $method], $body);
                                ob_start();
                                call_user_func_array(['Router','getComponents'], [$class, $method, $arResult]);
                                $content = ob_get_clean();
                            } else {
//                                throw new Exception();
                            }
                        } else {
//                            throw new Exception();
                        }
                    break;
                default:
//                    throw new Exception();
            }
        } catch (Exception $e) {
//            throw new Exception('Запрашиваемый ресурс отсутствует');
            $e->getMessage();
        }
    }

    private function parseURL($url)
    {
        $string = trim(str_replace('/', " ", $url));
        $arr = explode(" ", $string);
        switch ($arr[0]) {
            case "js":
            case "css":
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
        require_once(ROOT.'/assembers/js.php');
        exit(0);
    }
    private function getCss($class)
    {
        require_once(ROOT.'/assembers/css.php');
        exit(0);
    }
    private function getModules($class)
    {
        $modules = ROOT."/components/{$class}/".CLASS_COMPONENT;
        if (file_exists($modules)) {
            require_once($modules);
        }
    }
    private function getComponents($class, $method, $arResult)
    {
        $component = ROOT."/components/{$class}/{$method}/template.php";
        if (file_exists($component)) {
            require_once($component);
        }
    }
}