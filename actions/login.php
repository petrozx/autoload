<?
header('Access-Control-Allow-Origin: http://petroz.myjino.ru/');
require_once('../DB/DBCon.php');
$post = $_POST;
$db = new DBCon();
$users = $db->getUsers();
print_r($users, true);
foreach ($users as $user) {
    if ($user['email'] === $post['email'] && $user['pass'] === $post['password']) {
        return json_encode(['error' => 0, 'success' => 1]);
    } else {
        return json_encode(['error' => 1, 'success' => 0]);
    }
}








// if ($post['method'] == 'reg'){
//     $db = new DBCon();
//     $id = $db->saveUser($post['name'], $post['password'], $post['email']);
//     echo json_encode(['id' => $id]);
//     $db->close();
// } elseif ($post['method'] == 'allUser') {
//     $db = new DBCon();
//     $users = $db->getUsers();
//     echo json_encode($users, true);
//     $db->close();
// }