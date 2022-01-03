<?
if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $tebleChat = 'chats'.$_POST['chatWith'];
        var_dump($tebleChat);
        $bd = new DB($tebleChat);
        $is_exist = $bd->checkTable($tebleChat);
        if ($is_exist == 'OK') {
            $res = $bd->getRows();
        } else {
            $bd->createTable(['message', 'author']);
            die();
        }
        $bd->close_connection();
        die(json_encode($res, true));
    }
}

function sendMessage() {
    if ($_POST['method'] == 'send'){
        $bd = new DB('chats');
        $res = $bd->saveRows([$_POST['message'], $_SESSION['auth']['name']?:'Гость']);
        $bd->close_connection();
        die(json_encode(['error' => 0, 'success' => 1], true));
    }
}

function update() {
    if ($_POST['method'] == 'update'){
        $bd = new DB('chats');
        $res = $bd->getFilterRows('id>'. $_POST['id']);
        $bd->close_connection();
        die(json_encode($res, true));
    }
}

function users() {
    $bd = new DB('users');
    $res = $bd->getRows();
    $bd->close_connection();
    foreach($res as $user) {
        $array = array(
            'id' => $user['id'],
            'name' => $user['name']
        );
        $arRes[] = $array;
    }
    die(json_encode($arRes, true));
}


