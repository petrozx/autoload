<div class="feature col chats-block">
    <div class="feature-icon bg-primary bg-gradient position-relative">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?=$color?>">
        <?=$countUnRead?>
            <span class="visually-hidden">unread messages</span>
        </span>
        <a style="color: white" href="/chat/private/?user=<?=$user['id']?>">
            <svg class="bi" width="1em" height="1em">
                <use xlink:href="#people-circle"></use>
            </svg>
        </a>
    </div>
    <h3><?=$user['name']?></h3>
    <a class="icon-link" href="/chat/private/?user=<?=$user['id']?>">Написать
        <svg class="bi" width="1em" height="1em">
            <use xlink:href="#chevron-right"></use>
        </svg></a>
</div>