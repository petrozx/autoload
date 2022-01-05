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
    <body>
        <div class="container-xs">
            <div class="user-info"><a><?= $_SESSION['auth']['name'] ?: 'Гость' ?></a></div>
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
                                    foreach ($users as $user):?>
                                        <li><a class="dropdown-item" href="/chat/private/?user=<?php echo $user['id']?>"><?php echo $user['name']?></a></li>
                                    <?endforeach?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login/register">Регистрация</a>
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
            <div class="footer">
                <script src="/js/script.js"></script>
                <? if ($js) : ?>
                    <script src="<?= $js ?>"></script>
                <? endif; ?>
                <div class="made">
                    <a>©Made by petroz</a>
                </div>
            </div>
        </div>
    </body>
</html>