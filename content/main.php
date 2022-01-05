    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/main.css">
        <?if ($css):?>
            <link rel="stylesheet" href="<?=$css?>">
        <?endif;?>
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="user-info"><a><?=$_SESSION['auth']['name']?:'Гость'?></a></div>
            <nav>
                <ul class="navbar">
                    <li><a href="/car/mycar/">выберите машину</a></li>
                    <li><a href="/chat/">Чат</a></li>
                    <li><a href="/menu/list/">Наше меню</a></li>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/login/register">Регитрация</a></li>
                </ul>
            </nav>
            <div class="wrapper-container">
                <h1>Hi you are on my site</h1>
                <div id="root">
                    <?=$content?>
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