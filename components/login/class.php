<?

class Login
{
    public function register() {
            return $_SESSION['auth'];
    }

    public function profile(): string
    {
        return htmlentities($_SESSION['auth']['name'], ENT_IGNORE, "UTF-8");
    }
}