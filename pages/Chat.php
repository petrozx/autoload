<?
Class Chat
{
    public function index() {
        return '<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">'.$this->chats().'</div>';
    }

    public function private($name) {
            return '
            <div class="connect"></div>
            <form id="chat">
            <div class="messages form-control" ></div>
            <input type="text" name="message" class="message form-control form-control-lg" placeholder="введите сообщение">
            <div class="mike">&#127908;</div>
            <button id="send-message" class="btn btn-lg btn-outline-primary">отправить</button>
            </form>';
    }

    private function chats() {
        $res = '';
        $bd = new DB('users');
        $users = $bd->getRows();
        foreach ($users as $user):
            if ($user['id'] !== $_SESSION['auth']['id']):
                $res .= '<div class="feature col">
                            <div class="feature-icon bg-primary bg-gradient">
                                <a style="color: white" href="/chat/private/?user='.$user['id'].'">
                                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                                </a>
                            </div>
                            <h3>'.$user['name'].'</h3>
                            <p class="online"></p>
                            <a class="icon-link" href="/chat/private/?user='.$user['id'].'">Написать
                            <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg></a>
                        </div>';
            endif;
        endforeach;
        return $res;
    }
}
?>
