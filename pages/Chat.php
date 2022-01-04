<?
Class Chat
{
    public function index() {
        return '<div class="chats"></div>';
    }

    public function private($name) {
        if (!empty($_SESSION['auth'])) {
            return '
            <div class="connect"></div>
            <form id="chat">
            <div class="messages" ></div>
            <input type="text" name="message" class="message" placeholder="введите сообщение">
            <button type="submit">отправить</button>
            </form>';
        } else {
            return '<div class="connect"></div>';
        }
    }
}
?>
