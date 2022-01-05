<?

class Login
{
    public function register() {
        if (empty($_SESSION['auth'])) {
            return '
            <form id="register">
                <label class="form-label" for="name">Введите логин:</label>
                    <input class="form-control" type="text" name="name"><br>
                <label class="form-label" for="password">Введите пароль:</label>
                    <input class="form-control" type="password" name="password"><br>
                <label class="form-label" for="email">Введите почту:</label>
                    <input type="email" name="email"><br>
                <div class="btn btn-primary buttons">
                    <button id="reg">Зарегитрироваться</button>
                    <button id="login">Войти</button>
                </div>
            </form>
            ';
        } else {
            return '<button type="button" id="logout" >Выйти</button>';
        }
    }
}