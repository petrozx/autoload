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
            <button id="register" type="submit">Зарегитрироваться</button>
            <button id="login" type="submit">Войти</button>
        </form>
        ';
        $GLOBALS['script'] = '/js/login.js';
    }
}