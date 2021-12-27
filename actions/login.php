<?
header('Access-Control-Allow-Origin: http://petroz.myjino.ru/');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Max-Age: 10000');
require_once('../DB/DBCon.php');

$post = $_POST;
$db = new DBCon();
$id = $db->save($post['name'], $post['password'], $post['email']);

echo json_encode(['id' => $id]);