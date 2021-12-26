
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>


    <div class="wrapper">
        <h1>Hi you are on my site</h1>
        <?=$_SESSION['message']?></br>
        <ul>
            <li><a href="/car/mycar/nissan/">выберите машину</a></li>
            <li><a href="/showhello/sayhello/">Скажите привет</a></li>
            <li><a href="/">Главная</a></li>

        </ul>
        <?if (isset($_SESSION['script'])):?>
        <script src="<?=$_SESSION['script']?>"></script>
        <?endif;?>