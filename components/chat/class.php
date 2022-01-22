<?
Class Chat
{

    public function private($name) {
        if ($_GET['user'] != 'undefined') {
            $bd = new DB('users');
            $name = $bd->getFilterRows('id='.$_GET['user']);
            $bd->close_connection();
        }
        return $name;
    }

    public function index() {
        $bd = new DB();
        $bd->setTable('users');
        $users = $bd->getRows();
        $unRead = $bd->getFilterRows('is_read=0 AND what_a_chat='.$_SESSION['auth']['id'].' AND author='.$user['id']);
        $countUnRead = count($unRead);
        $chat_info[] = array(
            'name' => $user['name'],
            'id' => $user['id'],
            'color' => $color,
            'count_unread' => $countUnRead,
            'last' => $last
        );
        $bd->setTable('chat');
        foreach ($users as $user){
            if($user['date_update'] + 10*60 > time()) {
                $color = 'bg-danger';
            } else {
                $color = 'bg-secondary';
                $last = date('h:i:s d-m-Y',$user['date_update']);
            }
        }
        $bd->close_connection();
        return $chat_info;
    }
}
?>
