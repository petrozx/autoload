    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <h1>Hi you are on my site</h1>
            <?=$_SESSION['message']?></br>
            <ul>
                <li><a href="/car/mycar/">выберите машину</a></li>
                <li><a href="/showhello/sayhello/">Скажите привет</a></li>
                <li><a href="/menu/list/">Наше меню</a></li>
                <li><a href="/">Главная</a></li>
    
            </ul>
            <?if (isset($_SESSION['script'])):?>
            <script src="<?=$_SESSION['script']?>"></script>
            <?endif;?>
    </body>
    </html>