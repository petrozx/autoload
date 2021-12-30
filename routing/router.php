<?

Class Router
{

    public function __construct($url)
    {
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = ucfirst($class)?:'Index';
        $method = $method?:'index';
        if ($action == 'api') {
            $res = call_user_func(lcfirst($class));
            var_dump($res);
        } else {
            try {
                $instance = new $class($body);
                if (method_exists($instance, $method)) {
                    call_user_func([$instance, $method], $body);
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