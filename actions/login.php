<?
require_once('../DB/DBCon.php');
$post = $_POST;
if ($post['method'] === 'login')
{
    $db = new DBCon();
    $users = $db->getUsers();
    $db->close();
    if (is_array($users)){
        foreach ($users as $user) {
            if ($post['email'] === $user['email']){
                $verify = password_verify($post['password'],$user['password']);
                $_SESSION['auth'] = true;
                die(json_encode(['error' => 0, 'success' => 1]));
            }
        }
    }
    die(json_encode(['error' => 1, 'success' => 0]));
}
else if ($post['method'] === 'register')
{
    $db = new DBCon();
    $isHas = $db->findUser($post['email']);
    if ($isHas == 0) {
        $newUser = $db->saveUser($post['name'], $post['password'], $post['email']);
        $db->close();
        die(json_encode(['error' => 0, 'success' => 1]));
    } else {
        $db->close();
        die(json_encode(['error' => 1, 'success' => 0]));
    }
}