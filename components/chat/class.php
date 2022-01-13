<?
Class Chat
{
    public function index() {
        return '<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">'.$this->chats().'</div>';
    }

    public function private($name) {
        if ($_GET['user'] != 'undefined') {
            $bd = new DB('users');
            $name = $bd->getFilterRows('id='.$_GET['user']);
            $bd->close_connection();
        }
    }

    private function chats() {
        $res = '';
        $bd = new DB('users');
        $users = $bd->getRows();
        $bd->close_connection();
        $newBD = new DB('chat');
        foreach ($users as $user):
            if($user['date_update'] + 10*60 > time()) {
                $color = 'bg-danger';
            } else {
                $color = 'bg-secondary';
            }
            $unRead = $newBD->getFilterRows('is_read=0 AND what_a_chat='.$_SESSION['auth']['id'].' AND author='.$user['id']);
            if ($user['id'] != $_SESSION['auth']['id']):
                $countUnRead = count($unRead);?>
                <div class="feature col chats-block">
                            <div class="feature-icon bg-primary bg-gradient position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?=$color?>"><?=
                                $countUnRead?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                                <a style="color: white" href="/chat/private/?user=<?=$user['id']?>">
                                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                                </a>
                            </div>
                            <h3><?=$user['name']?></h3>
                            <a class="icon-link" href="/chat/private/?user=<?=$user['id']?>">Написать
                            <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg></a>
                        </div>
            <?endif;
        endforeach;
        $newBD->close_connection();
        return ob_get_clean();
    }
}
?>
