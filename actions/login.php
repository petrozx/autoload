<?

if(!defined('MyConst')) {
    die('Direct access not permitted');
 }

require_once('../DB/DBCon.php');
$get = $_GET;
$post = $_POST;
if (!empty($post)){
    $db = new DBCon();
    $id = $db->save($post['name'], $post['password'], $post['email']);
    echo json_encode(['id' => $id]);
    $db->close();
} else {
    $db = new DBCon();
    $users = $db->getUsers();
    echo json_encode($users);
    $db->close();
}