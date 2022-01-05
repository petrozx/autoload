<?

class Login
{
    public function register() {
        if (empty($_SESSION['auth'])) {
            return '
            <div class="text-center">
                <div class="form-signin"
                    <div class="mb-3">
                        <form id="register">
                        <h3 class="form-label mb-3">Форма авторизации:</h3>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Login">
                                <label for="floatingInput">Login</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingInput" name="password" placeholder="Password">
                                <label for="floatingInput">Password</label>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="buttons">
                                <button class="w-100 mb-2 btn btn-lg btn-primary" id="reg">Регистрация</button>
                                <button class="w-100 btn btn-lg btn-primary" id="login">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ';
        } else {
            return '<button class="btn btn-primary" type="button" id="logout" >Выйти</button>';
        }
    }
}