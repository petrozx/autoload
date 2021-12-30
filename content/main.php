    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/main.css">
        <?if (isset($GLOBALS['css'])):?>
            <link rel="stylesheet" href="<?=$GLOBALS['css']?>">
        <?endif;?>
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <ul class="navbar">
                    <li><a href="/car/mycar/">выберите машину</a></li>
                    <li><a href="/showhello/sayhello/">Скажите привет</a></li>
                    <li><a href="/menu/list/">Наше меню</a></li>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/login/register">Регитрация</a></li>
                </ul>
            </nav>
            <h1>Hi you are on my site</h1>
            <div id="root">
                <?=$GLOBALS['content']?>
            </div>
            <div class="footer">
                <?if (isset($GLOBALS['script'])):?>
                    <script src="<?=$GLOBALS['script']?>"></script>
                <?endif;?>
                <div class="made">
                    <a>©Made by petroz</a>
                </div>
            </div>
        </div>
    </body>
    </html>