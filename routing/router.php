<?

Class Router
{

    public function __construct($url)
    {
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = ucfirst($class)?:'Index';
        $method = $method?:'index';
        if ($action == 'api') {
            call_user_func(lcfirst($class), $body);
        } else {
            try {
                $instance = new $class($body);
                if (method_exists($instance, $method)) {
                    $res = call_user_func([$instance, $method], $body);
                    var_dump($res);
                }
            } catch (Exception $e) {
                throw new Exception('Запрашиваемый ресурс отсутствует');
            }
        }
    }

    private function parseURL($url)
    {
        $string = trim(str_replace('/', " ", $url));
        $arr = explode(" ", $string);
        $arr[0]!=='api' ? array_unshift($arr, "_") : $arr;
        return $arr;
    }

}
?>