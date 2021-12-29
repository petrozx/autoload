<?
require_once('../DB/DBCon.php');
$post = $_POST;


if ($post['method'] === 'login') {
    $db = new DBCon();
    $users = $db->getUsers();
    $db->close();
    foreach ($users as $user) {
        echo '<pre?>'.print_r($user).'</pre>';
    }
    die(json_encode(['error' => 1, 'success' => 0]));

} elseif ($post['method'] === 'register') {
    $db = new DBCon();
    $newUser = $db->saveUser($post['name'], $post['password'], $post['email']);
    $db->close();
}