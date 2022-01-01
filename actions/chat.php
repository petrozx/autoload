<?if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $bd = new DB('chats');
        $res = $bd->getRows();
        echo json_encode($res, true);
    }
}

