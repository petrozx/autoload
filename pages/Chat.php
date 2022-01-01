<?
Class Chat
{
    public function index() {
        return '
        <form id="chat">
        <input type="text" class="messages" size="40" placeholder="тут будут все сообщения">
        <input type="text" name="message" class="message" placeholder="введите сообщение">
        <input type="hidden" name="author" class="message" value='.$GLOBALS['auth']['name'].'>
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
