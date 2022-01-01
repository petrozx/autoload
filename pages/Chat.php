<?
Class Chat
{
    public function index() {
        return '
        <form id="chat">
        <textarea readonly rows="10" cols="45" class="messages" placeholder="тут будут все сообщения"></textarea>
        <input type="text" name="message" class="message" placeholder="введите сообщение">
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
