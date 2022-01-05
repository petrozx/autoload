<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <? if ($css) : ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <? endif; ?>
        <title>Petroz.dev</title>
    </head>
    <style>
        body {
            padding-top: 20px;
        }

        .text-end {
            height: 40px;
        }

        footer {
        position: absolute;
        bottom: 0;
        height: 50px;
        background-color: #f8f9fa
        }
    </style>
    <body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
    </svg>
        <div class="container">
            <div class="text-end">
                <?=empty($_SESSION['auth'])?'Гость'
                :'<span class="fs-4">'.$_SESSION['auth']['name'].'</span>'.
                '<button id="logout" class="btn btn-primary btn-sm">Выйти
                </button>'?>
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
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <? $bd = new DB('users');
                                    $users = $bd->getRows();
                                    foreach ($users as $user):
                                        if ($user['id'] !== $_SESSION['auth']['id']):?>
                                            <li><a class="dropdown-item" href="/chat/private/?user=<?php echo $user['id']?>"><?php echo $user['name']?></a></li>
                                        <?endif;?>
                                    <?endforeach?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?if(!empty($_SESSION['auth'])):?>disabled<?endif?>" href="/login/register">Войти</a>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <h1>Hi you are on my site</h1>
                <div class="wrapper-container">
                    <div id="root">
                        <?= $content ?>
                    </div>
                </div>
            <footer class="container">
                <script src="/js/script.js"></script>
                <? if ($js) : ?>
                    <script src="<?= $js ?>"></script>
                <? endif; ?>
                <div class="made">
                    <a>©Made by petroz</a>
                </div>
            </footer>
        </div>
    </body>
</html>