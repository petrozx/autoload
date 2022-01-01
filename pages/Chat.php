<?
Class Chat
{
    public function index() {
        return '
        <form id="chat">
        <textarea readonly rows="10" cols="45" class="messages" placeholder="тут будут все сообщения"></textarea>
        <input type="text" name="message" class="message" placeholder="введите сообщение">
        <input type="hidden" name="author" class="message" value='.$GLOBALS['auth']['name'].'>
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
