<?
Class Chat
{
    public function index() {
        return '<div class="chats"></div>';
    }

    public function private() {
        return '
        <div class="connect"></div>
        <form id="chat">
        <div class="messages" ></div>
        <input type="text" name="message" class="message" placeholder="введите сообщение">
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
