<?
Class Chat
{
    public function index() {
        return '
        <form id="chat">
        <input type="text" name="message" class="messages" size="40" placeholder="тут будут все сообщения">
        <input type="text" name="author" class="message" placeholder="введите сообщение">
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
