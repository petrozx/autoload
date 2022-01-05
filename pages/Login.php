<?

class Login
{
    public function register() {
        if (empty($_SESSION['auth'])) {
            return '
            <div class="text-center">
                <div class="form-signin"
                    <form id="register">
                        <div class="mb-3">
                            <label class="form-label" for="name">Введите логин:</label>
                                <input class="form-control" type="text" name="name"><br>
                            <label class="form-label" for="password">Введите пароль:</label>
                                <input class="form-control" type="password" name="password"><br>
                            <label class="form-label" for="email">Введите почту:</label>
                                <input class="form-control" type="email" name="email"><br>
                            <div class="buttons">
                                <button class="btn btn-primary" id="reg">Зарегитрироваться</button>
                                <button class="btn btn-primary" id="login">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ';
        } else {
            return '<button class="btn btn-primary" type="button" id="logout" >Выйти</button>';
        }
    }
}