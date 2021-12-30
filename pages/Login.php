<?

class Login
{
    public function register() {
        if (empty($_SESSION['name'])) {
            $GLOBALS['content'] = '
            <form id="register">
                <label for="name">Введите логин:</label>
                    <input type="text" name="name"><br>
                <label for="password">Введите пароль:</label>
                    <input type="password" name="password"><br>
                <label for="email">Введите почту:</label>
                    <input type="email" name="email"><br>
            </form>
            <button id="reg">Зарегитрироваться</button>
            <button id="login">Войти</button>
            ';
        } else {
            $GLOBALS['content'] = '<button type="button" id="logout" >Выйти</button>';
        }
    }
}