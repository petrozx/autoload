<?
Class Chat
{
    public function index() {
            $bd = new DB('users');
            $users = $bd->getRows();
            foreach ($users as $user):
                if ($user['id'] !== $_SESSION['auth']['id']):?>
                    <div class="feature col">
                        <div class="feature-icon bg-primary bg-gradient">
                            <a class="dropdown-item" href="/chat/private/?user=<?php echo $user['id']?>"><?php echo $user['name']?></a>
                        </div>
                    </div>
                <?endif;
            endforeach;
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
}
?>
