<?
require_once('../DB/DBCon.php');
$post = $_POST;
$db = new DBCon();
$users = $db->getUsers();
foreach ($users as $user) {
    if ($user['email'] === $post['email'] && $user['pass'] === $post['password']) {
        die(json_encode(['error' => 0, 'success' => 1]));
    } 
}
die(json_encode(['error' => 1, 'success' => 0]));








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