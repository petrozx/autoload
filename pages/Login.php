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
                            <h3 class="form-label mb-3">Форма авторизации:</h3>
                                <input class="form-control" type="text"placeholder="Логин" name="name"><br>
                                <input class="form-control" type="password" placeholder="Пароль" name="password"><br>
                                <input class="form-control" type="email" placeholder="name@example.com" name="email"><br>
                            <div class="buttons">
                                <button class="w-100 mb-2 btn btn-lg btn-primary" id="reg">Зарегитрироваться</button>
                                <button class="w-100 btn btn-lg btn-primary" id="login">Войти</button>
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