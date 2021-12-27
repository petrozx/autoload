<?
class Login
{
    public function register() {
        $GLOBALS['content'] = '
        <form>
            <label for="name">Введите логин:</label>
                <input type="text" name="name"><br>
            <label for="password">Введите пароль:</label>
                <input type="password" name="password"><br>
            <label for="email">Введите почту:</label>
                <input type="email" name="email"><br>
            <button type="submit">Зарегитрироваться</button>
        </form>
        ';

    }
}