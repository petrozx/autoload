<?

function login(){
    if ($_POST['method'] === 'login')
    {
        $db = new DBCon();
        $users = $db->getUsers();
        $db->close();
        if (is_array($users)){
            foreach ($users as $user) {
                if ($_POST['email'] === $user['email']){
                    $verify = password_verify($_POST['password'],$user['password']);
                    if ($verify) {
                        $_SESSION['auth'] = 'true';
                        return json_encode(success);
                    }
                }
            }
        }
    }
    return json_encode(nosuccess);
}

function register(){
    if ($_POST['method'] === 'register')
    {
        $db = new DBCon();
        $isHas = $db->findUser($_POST['email']);
        if ($isHas == 0) {
            $newUser = $db->saveUser($_POST['name'], $_POST['password'], $_POST['email']);
            $db->close();
            return json_encode(success);
        }
    }
    return json_encode(nosuccess);
}

function logout(){
    if ($_POST['method'] === 'logout')
    {
        unset($_SESSION['auth']);
        return json_encode(success);
    }
    return nosuccess;
}