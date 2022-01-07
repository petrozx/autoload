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
                        $_SESSION['auth'] = $user;
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
        foreach($users as $user){
            if (in_array($_POST['email'], $user)) {
                die( json_encode(['error' => 1, 'success' => 0]) );
            }
        }
        $idUser = $db->saveRows([$_POST['name'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email'],'0', time(), time()]);
        $objUser = $db->getFilterRows('id='.$idUser);
        $db->close_connection();
        $_SESSION['auth'] = $objUser[0];
        die( json_encode(['error' => 0, 'success' => 1]) );
    }
}

function logout(){
    if ($_POST['method'] === 'logout')
    {
        unset($_SESSION['auth']);
        die( json_encode(['error' => 0, 'success' =>1]) );
    }
    die( json_encode(['error' => 1, 'success' => 0]) );
}

function userAuth() {
    if(!empty($_SESSION['auth']))
        die( json_encode(['error' => 0, 'success' => $_SESSION['auth']['id']]) );
    else
        die( json_encode(['error' => 1, 'success' => 0]) );
}

function userUpdate() {
    $bd = new DB('users');
    if (!isset($_POST['password']))$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $res = $bd->updateRaw($_SESSION['auth']['id'], $_POST);
    $bd->close_connection();
    die(json_encode( ['success'=> $res] ));
}