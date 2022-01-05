    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <?if ($css):?>
            <link rel="stylesheet" href="<?=$css?>">
        <?endif;?>
        <title>Petroz.dev</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="user-info"><a><?=$_SESSION['auth']['name']?:'Гость'?></a></div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li><a class="nav-link active" href="/car/mycar/">выберите машину</a></li>
                    <li><a href="/chat/">Чат</a></li>
                    <li><a href="/menu/list/">Наше меню</a></li>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/login/register">Регитрация</a></li>
                </ul>
            </nav>
            <h1>Hi you are on my site</h1>
            <div class="main-wrapper">
                <div class="wrapper-container">
                    <div id="root">
                        <?=$content?>
                    </div>
                </div>
            </div>
            <div class="footer">
            <script src="/js/script.js"></script>
                <?if ($js):?>
                    <script src="<?=$js?>"></script>
                <?endif;?>
                <div class="made">
                    <a>©Made by petroz</a>
                </div>
            </div>
        </div>
    </body>
    </html>