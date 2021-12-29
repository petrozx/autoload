<?
class Login
{
    public function register() {
        $GLOBALS['content'] = '
        <form id="register">
            <label for="name">Введите логин:</label>
                <input type="text" name="name"><br>
            <label for="password">Введите пароль:</label>
                <input type="password" name="password"><br>
            <label for="email">Введите почту:</label>
                <input type="email" name="email"><br>
            <button id="register">Зарегитрироваться</button>
            <button id="login">Войти</button>
        </form>
        ';
        $GLOBALS['script'] = '/js/login.js';
    }
}