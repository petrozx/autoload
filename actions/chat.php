<?
if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $tebleChat = 'chats'.$_POST['chat'];
        $bd = new DB($tebleChat);
        $is_exist = $bd->checkTable($tebleChat);
        if ($is_exist == 'OK') {
            $res = $bd->getRows();
        } else {
            $bd->createTable(['message', 'author', 'author_id']);
            die();
        }
        $bd->close_connection();
        die(json_encode($res, true));
    }
}

function sendMessage() {
    if ($_POST['method'] == 'send'){
        $tebleChat = 'chats'.$_POST['chat'];
        $bd = new DB($tebleChat);
        $res = $bd->saveRows([ $_POST['message'], ($_SESSION['auth']['name']?:'Гость'), ($_POST['to_whom_message']?:'') ]);
        $bd->close_connection();
        die(json_encode(['error' => 0, 'success' => 1], true));
    }
}

function update() {
    if ($_POST['method'] == 'update'){
        $tableFrom = 'chats'.$_POST['chatFrom'];
        $bd = new DB($tableFrom);
        $is_exist = $bd->checkTable($tableFrom);
        $bd->close_connection();
        if ($is_exist == 'OK') {
            $res = $bd->getFilterRows('id>'. $_POST['id']);
        } else {
            $bd->createTable(['message', 'author', 'to_whom_message']);
            die();
        }
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
            'name' => $user['name'],
            'date_update' => $user['date_update']
        );
        $arRes[] = $array;
    }
    die(json_encode($arRes, true));
}

function online() {
    $bd = new DB('users');
    $bd->isOnline();
}
