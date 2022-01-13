<?global $arResult;?>
<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <?foreach($arResult as $res):?>
    <div class="feature col chats-block">
        <div class="feature-icon bg-primary bg-gradient position-relative">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?=$res['color'] ?>">
                <?= $res['count_unread'] ?>
                <span class="visually-hidden">unread messages</span>
            </span>
            <a style="color: white" href="/chat/private/?user=<?=$res['id'] ?>">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#people-circle"></use>
                </svg>
            </a>
        </div>
        <h3><?=$res['name'] ?></h3>
        <a class="icon-link" href="/chat/private/?user=<?=$res['id'] ?>">Написать
            <svg class="bi" width="1em" height="1em">
                <use xlink:href="#chevron-right"></use>
            </svg></a>
    </div>
    <? endforeach?>
</div>