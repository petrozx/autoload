<?

Class Router
{

    public function __construct($url)
    {
        [$action, $class, $method, $body] = $this->parseURL($url);
        $class = ucfirst($class)?:'Index';
        $method = $method?:'index';
        die(print_r($action,true));
        if ($action === 'api') {
            
            call_user_func($class, $body);
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
        $result = str_replace('/', " ", $url);
        $result = explode(" ", $result);
        return $result;
    }

}
?>