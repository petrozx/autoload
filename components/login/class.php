<?

class Login
{
    public function register() {
            return $_SESSION['auth'];
    }

    public function profile() {
        $name = htmlentities($_SESSION['auth']['name'], ENT_IGNORE, "UTF-8");
        return $name;
    }
}