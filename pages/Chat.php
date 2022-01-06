<?
Class Chat
{
    public function index() {
        return '<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">'.$this->chats().'</div>';
    }

    public function private($name) {
            return '
            <div class="connect alert alert-primary">
                <div class="d-flex align-items-center">
                    <span id="alert">Загрузка...</span>
                    <div class="spinner-border text-primary ms-auto d-none" role="status" aria-hidden="true"></div>
                </div>
            </div>
            <form id="chat">
            <div class="messages mb-2 form-control" >
            </div>
            <input type="text" name="message" class="message mb-2 form-control form-control-lg" placeholder="введите сообщение">
            <div class="mike">&#127908;</div>
            <button id="send-message" class="btn mb-4 btn-lg btn-outline-primary">отправить</button>
            </form>';
    }

    private function chats() {
        $res = '';
        $bd = new DB('users');
        $users = $bd->getRows();
        $bd->close_connection();
        $newBD = new DB('chat');
        foreach ($users as $user):
            if($user['date_update'] + 10*60 > time()) {
                $curent = 'В сети';
                $color = 'bg-danger';
            } else {
                $curent = 'Не в сети';
                $color = 'bg-secondary';
            }
            if ($user['id'] != $_SESSION['auth']['id']):
                $unRead = $newBD->getFilterRows('is_read=0 AND what_a_chat='.$_SESSION['auth']['id'].' AND author='.$user['id']);
                $countUnRead = empty($unRead)?'-':count($unRead);
                $res .= '<div class="feature col chats-block">
                            <div class="feature-icon bg-primary bg-gradient position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill '.$color.'">'.
                                $countUnRead.'
                                <span class="visually-hidden">unread messages</span>
                            </span>
                                <a style="color: white" href="/chat/private/?user='.$user['id'].'">
                                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                                </a>
                            </div>
                            <h3>'.$user['name'].'</h3>
                            <p class="online">'.$curent.'</p>
                            <a class="icon-link" href="/chat/private/?user='.$user['id'].'">Написать
                            <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg></a>
                        </div>';
            endif;
        endforeach;
        $newBD->close_connection();
        return $res;
    }
}
?>
