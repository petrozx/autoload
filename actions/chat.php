<?
// if ($_SERVER['REQUEST_METHOD'] == 'GET') die();

function getMessage() {
    if ($_POST['method'] == 'getAll'){
        $bd = new DB('chats');
        $res = $bd->getRows();
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

function websock() {
    $chat = new Chat();
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, true);
    socket_bind($socket, 0, 80);
    socket_listen($socket, true);
    while (true) {
        $newSocket = socket_accept($socket);
        $header = socket_read($newSocket, 1024);
        $chat->sendHeaders($header, $newSocket, 'petroz.myjino.ru/chat/', 80);
    }

    socket_close($socket);
}



