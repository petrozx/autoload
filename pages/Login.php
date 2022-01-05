<?

class Login
{
    public function register() {
        if (empty($_SESSION['auth'])) {
            return '
            <main class="text-center">
                <form id="register">
                    <div class="mb-3 md">
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
            </main>
            ';
        } else {
            return '<button class="btn btn-primary" type="button" id="logout" >Выйти</button>';
        }
    }
}