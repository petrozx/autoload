<?
header('Access-Control-Allow-Origin: http://petroz.myjino.ru/');
require_once('../DB/DBCon.php');
$post = $_POST;
if ($post['method'] == 'reg'){
    $db = new DBCon();
    $id = $db->save($post['name'], $post['password'], $post['email']);
    echo json_encode(['id' => $id]);
    $db->close();
} elseif ($post['method'] == 'allUser') {
    $db = new DBCon();
    $users = $db->getUsers();
    echo json_encode($users);
    $db->close();
}