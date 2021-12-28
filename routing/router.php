<?

Class Router
{

    public function __construct($url)
    {
        [$class, $method, $name] = $this->parseURL($url);
        $class = ucfirst($class)?:'Index';
        $method = $method?:'index';
        $file = $_SERVER['DOCUMENT_ROOT'].'/pages/'. $class.'.php';
        try {
            $instance = new $class($name);
            $res = call_user_func([$instance, $method], $name);
            if($res){
                die();
            }
        } catch (Exception $e) {
            throw new Exception('Запрашиваемый ресурс отсутствует');
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