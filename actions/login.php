<?
require_once('../DB/DBCon.php');

$post = $_POST;
$db = new DBCon();
$id = $db->save($post['name'], $post['password'], $post['email']);

echo json_encode(['id' => $id]);