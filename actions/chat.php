<?if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $bd = new DB('chats');
        $res = $bd->getRows();
        $bd->close_connection();
        echo json_encode($res, true);
    }
}

function sendMessage() {
    if ($_POST['method'] == 'send'){
        $bd = new DB('chats');
        $res = $bd->saveRows([$_POST['message'], $_POST['author']]);
        $bd->close_connection();
        echo json_encode(['error' => 0, 'success' => 1]);
    }
}



