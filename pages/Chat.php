<?
Class Chat
{
    public function index() {
        return '
        <form id="chat">
        <input type="textarea" placeholder="тут будут все сообщения">
        <input type="text" placeholder="введите сообщение">
        <button type="submit">отправить</button>
        </form>';
    }
}
?>
