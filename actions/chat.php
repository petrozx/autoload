<?

if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $tebleChat = 'chats'.$_POST['chat'];
        $bd = new DB();
        $bd->setTable($tebleChat);
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
        $bd = new DB();
        $bd->setTable('chat');
        $res = $bd->saveRows([ time() ,$_POST['message'], $_SESSION['auth']['id'], $_POST['what_a_chat'], 'text', 0]);
        $bd->close_connection();
        die(json_encode(['error' => 0, 'success' => 1], true));
    }
}

function update() {
    if ($_POST['method'] == 'update'){
        $bd = new DB();
        $bd->setTable('chat');
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
    $bd = new DB();
    $bd->setTable('users');
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
        $bd = new DB();
        $bd->setTable('users');
        $bd->isOnline($_SESSION['auth']['id']);
        $mes = $bd->has_newMessage($_SESSION['auth']['id']);
        $bd->close_connection();
        die(json_encode(array('success' => 1, 'message' => $mes)));
    } else {
        die(json_encode(['success' => 0]));
    }
}

function save() {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/upload/';
    $mp3name = basename(md5($_FILES['voice']['tmp_name'].time()).'.mp3');
    $output = array();
    $result_code = "";
    exec("ffmpeg -i '{$_FILES['voice']['tmp_name']}' -crf 23 '{$uploadDir}{$mp3name}'", $output,$result_code);
    if (!$result_code) {
        $response = ['result'=>'OK'];
        $bd = new DB();
        $bd->setTable('chat');
        $res = $bd->saveRows([ time() ,'/upload/'. $mp3name, $_SESSION['auth']['id'], $_POST['what_a_chat'], 'audio', 0 ]);
        $bd->close_connection();
    } else {
        $response = ['result'=>'ERROR'];
    }
    die(json_encode($response));
}

function mesRead() {
    $data = json_decode(file_get_contents('php://input'), true);
    $bd = new DB();
    $bd->setTable('chat');
    foreach($data as $mes) {
        if ($_SESSION['auth']['id'] != $mes['author']) {
            $bd->updateRaw($mes['id'], array('is_read' => 1) );
        }
    }
    $bd->close_connection();
    die( json_encode(['error' => 0]) );
}

function saveFile() {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/upload/';
    $nameFile = basename($_FILES['file']['name']);
    $uploadfile = $uploadDir . $nameFile;
    $res = move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    if ($res) {
        $response = ['result'=>'OK'];
        $bd = new DB();
        $bd->setTable('chat');
        $res = $bd->saveRows([ time() , '/upload/'. $nameFile, $_SESSION['auth']['id'], $_POST['what_a_chat'], 'file', 0 ]);
        $bd->close_connection();
    } else {
        $response = ['result'=>'ERROR'];
    }
    die(json_encode($response));
}