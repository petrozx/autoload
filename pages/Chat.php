<?
header('Location: http://'.$_SERVER['HTTP_HOST'].'/login/register');
Class Chat
{
    public function index() {
        if (!empty($_SESSION['auth'])) {
            return '<div class="chats"></div>';
        } else {
            return '<div class="connect">Вы не авторизированы</div>';
        }
    }

    public function private($name) {
            return '
            <div class="connect"></div>
            <form id="chat">
            <div class="messages" ></div>
            <input type="text" name="message" class="message" placeholder="введите сообщение">
            <div class="mike">&#127908;</div>
            <button type="submit">отправить</button>
            </form>';
    }
}
?>
