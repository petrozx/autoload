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
        $bd = new DB('chat');
        $res = $bd->saveRows([ time() ,$_POST['message'], $_SESSION['auth']['id'], $_POST['what_a_chat'], 'text', 0]);
        $bd->close_connection();
        die(json_encode(['error' => 0, 'success' => 1], true));
    }
}

function update() {
    if ($_POST['method'] == 'update'){
        $bd = new DB('chat');
        $res = $bd->getFilterRows(
            'date_create>'.$_POST['date_create'].
            ' AND author=' . $_SESSION['auth']['id'].
            ' AND what_a_chat='.$_POST['chat'].
            ' OR author='.$_POST['chat'].
            ' AND date_create>'.$_POST['date_create'].
            ' AND what_a_chat='.$_SESSION['auth']['id']
        );
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
    if (!empty($_SESSION['auth'])) {
        $bd = new DB('users');
        $bd->isOnline($_SESSION['auth']['id']);
        $bd->close_connection();
        die(json_encode(['success' => 1]));
    } else {
        die(json_encode(['success' => 0]));
    }
}

function save(){
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/upload/';
    $typeFile = explode('/', $_FILES['voice']['type']);
    $wayFile = basename(md5($_FILES['voice']['tmp_name'].time()).'.'.$typeFile[1]);
    $uploadFile = $uploadDir . $wayFile;
    if (move_uploaded_file($_FILES['voice']['tmp_name'], $uploadFile)) {
        $response = ['result'=>'OK'];
        $bd = new DB('chat');
        $res = $bd->saveRows([ time() ,'/upload/'. $wayFile, $_SESSION['auth']['id'], $_POST['what_a_chat'], 'audio' ]);
        $bd->close_connection();
    } else {
        $response = ['result'=>'ERROR'];
    }
    die(json_encode($response));
}