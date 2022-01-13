<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/babel-standalone@6/babel.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="/css/style.css" rel="stylesheet">
        <? if ($css) : ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <? endif; ?>
        <title>Petroz.dev</title>
    </head>
    <style>
    .container {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
    }

    .chats-block {
        align-content: stretch;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
    }

    .badge {
        padding: 0.11em 0.45em;
        font-size: .55em;
        font-weight: 500;
    }
    </style>
    <body class="d-flex flex-column h-100">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
    </svg>
        <div class="container-lg">
            <div class="py-5 mb-3 border-bottom profile">
                <div class="text-end">
                <div class="dropdown">
                    <div class="col-12 d-flex justify-content-end align-items-center profile__name">
                        <?=empty($_SESSION['auth'])?'<span class="fs-4">Гость</span>'
                        :'<a class="fs-4 me-4 btn btn-light btn-sm dropdown-toggle position-relative profile__name" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">'.$_SESSION['auth']['name'].
                        '</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Профиль</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><a class="dropdown-item" id="logout" href="#">Выход</a></li>
                        </ul>';
                        ?>
                    </div>
                </div>
                </div>
                <a href="/chat" id="new-message" class="new-message">
                    <svg class="message__top" width="40" height="17" viewBox="0 0 220 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M110.743 92.3574L5.40349 2H214.652L110.743 92.3574Z" fill="#0D6EFD" stroke="#FFFCFC" stroke-width="3"/>
                        </svg>
                    <svg class="message__body" width="38.91" height="25" viewBox="0 0 222 148" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.07468 6.31327L2 4.35427V8V144V146H4H218H220V144V8V4.33541L216.918 6.31796L111.507 74.1253L5.07468 6.31327Z" fill="#0D6EFD" stroke="white" stroke-width="3"/>
                        <line y1="-2" x2="253.559" y2="-2" transform="matrix(0.843986 -0.536365 0.55448 0.832197 4 144)" stroke="white" stroke-width="3"/>
                        <line y1="-2" x2="253.559" y2="-2" transform="matrix(0.843986 0.536365 -0.55448 0.832197 4 8)" stroke="white" stroke-width="3"/>
                    </svg>
                    <svg class="message__intro" width="38" height="21" viewBox="0 0 209 116" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="209" height="116" fill="white" stroke="black"/>
                        <line x1="38" y1="33.5" x2="171" y2="33.5" stroke="black" stroke-width="4"/>
                        <line x1="38" y1="54.5" x2="171" y2="54.5" stroke="black" stroke-width="4"/>
                        <line x1="38" y1="74.5" x2="171" y2="74.5" stroke="black" stroke-width="4"/>
                        </svg>
                </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="/images/logo.png" alt="" width="30" height="30">
                        Petroz
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Главная</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="/chat" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Чат
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="/chat">Чаты</a></li>
                                    <?if (!empty($_SESSION['auth'])):
                                        $bd = new DB('users');
                                        $users = $bd->chatsWithMe($_SESSION['auth']['id']);
                                        $bd->close_connection();
                                        if ($users):?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                            <?foreach ($users as $user):?>
                                                    <li><a class="dropdown-item" href="/chat/private/?user=<?php echo $user['id']?>"><?php echo $user['name']?></a></li>
                                            <?endforeach;
                                        endif;
                                    endif?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?if(!empty($_SESSION['auth'])):?>disabled<?endif?>" href="/login/register">Войти</a>
                            </li>
                        </ul>
                        <div>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" id="search" type="submit">Поиск</button>
                        </form>
                        <ul class="dropdown-menu mt-1 border-top-0" id="search-box"></ul>
                        </div>
                    </div>
                </div>
            </nav>
            <h1></h1>
            <div class="container">
                <div id="main">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <footer class="container-lg footer mt-auto mh-20">
            <div class="bg-light" style="min-height: 70px;">
                <script src="/js/script.js"></script>
                <? if ($js) : ?>
                    <script src="<?= $js ?>"></script>
                <? elseif ($jsx) : ?>
                    <script type="text/babel" src="<?= $jsx ?>"></script>
                <? endif ?>
                <div class="made">
                    <span class="text-muted">©Made by petroz</span>
                </div>
            </div>
        </footer>
    </body>
</html>