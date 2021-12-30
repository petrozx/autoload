<?
if ($_SERVER['REQUEST_METHOD'] == 'GET') die();
function login(){
    if ($_POST['method'] === 'login')
    {
        $db = new DB('users');
        $users = $db->getRows();
        $db->close_connection();
        if (is_array($users)){
            foreach ($users as $user) {
                if ($_POST['email'] === $user['email']){
                    $verify = password_verify($_POST['password'],$user['password']);
                    if ($verify) {
                        $_SESSION['name'] = $user['name'];
                        die( json_encode(['error' => 0, 'success' => 1]) );
                    }
                }
            }
        }
    }
    die( json_encode(['error' => 1, 'success' => 0]) );
}

function register(){
    if ($_POST['method'] === 'register')
    {
        $db = new DB('users');
        $users = $db->getRows();
        die(var_dump($users));
        if (in_array($_POST['email'], $users)) {
            $newUser = $db->saveRows([$_POST['name'], $_POST['password'], $_POST['email'],'0']);
            $db->close_connection();
            die( json_encode(['error' => 0, 'success' => 1]) );
        }
    }
    die( json_encode(['error' => 1, 'success' => 0]) );
}

function logout(){
    if ($_POST['method'] === 'logout')
    {
        unset($_SESSION['name']);
        die( json_encode(['error' => 0, 'success' =>1]) );
    }
    die( json_encode(['error' => 1, 'success' => 0]) );
}