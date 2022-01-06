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
            <div class="messages form-control" >
            </div>
            <input type="text" name="message" class="message form-control form-control-lg" placeholder="введите сообщение">
            <div class="mike">&#127908;</div>
            <button id="send-message" class="btn btn-lg btn-outline-primary">отправить</button>
            </form>';
    }

    private function chats() {
        $res = '';
        $bd = new DB('users');
        $users = $bd->getRows();
        $newBD = new DB('chat');
        foreach ($users as $user):
            $unRead = $newBD->getFilterRows('is_read=0 AND author NOT IN ('.$_SESSION['auth']['id'].') AND what_a_chat='.$user['id']);
            if($user['date_update'] + 10*60 > time()) {
                $curent = 'В сети';
            } else {
                $curent = 'Не в сети';
            }
            if ($user['id'] !== $_SESSION['auth']['id']):
                $res .= '<div class="feature col chats-block">
                            <div class="feature-icon bg-primary bg-gradient position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.
                                count($unRead).'
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
        return $res;
    }
}
?>
