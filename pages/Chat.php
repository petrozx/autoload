<?
Class Chat
{
    public function index() {
        if (!empty($_SESSION['auth'])) {
            return '<div class="chats row g-4 py-5 row-cols-1 row-cols-lg-3"></div>';
        } else {
            return '<div class="connect">Вы не авторизированы</div>';
        }
    }

    public function private($name) {
            return '
            <div class="connect"></div>
            <form id="chat">
            <div class="messages form-control" ></div>
            <input type="text" name="message" class="message form-control form-control-lg" placeholder="введите сообщение">
            <div class="mike">&#127908;</div>
            <button id="send-message" class="btn btn-lg btn-outline-primary">отправить</button>
            </form>';
    }
}
?>
