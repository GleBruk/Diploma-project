<?php
// Если пользователь не авторизован, то происходит переадресация на страницу регистрации. Иначе выводится
// главная страница
    if($_COOKIE['login'] == ''):
        header('Location: user/reg');
    ?>
<?php else: ?>
    <?php require 'public/blocks/header.php'?>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Главная страница</title>
        <meta name="description" content="Главная страница интернет магазина">

        <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
        <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous" >
    </head>
    <body>
    <div class="container main">
        <h1>Сокра.тим</h1>
        <br>
        <p>Вам нужно сократить ссылку?Сейчас мы это сделаем!</p>
        <br>
        <form action="/home" method="post" class="form-control">
            <input type="text" name="long_link" placeholder="Длинная ссылка" value="<?=$_POST['long_link']?>"><br>
            <input type="text" name="short_link" placeholder="Короткая ссылка" value="<?=$_POST['short_link']?>"><br>
            <div class="error"><?=$data['message']?></div>
            <button class="btn" id="send">Уменьшить</button>
        </form>
        <br>
        <!-- Выводим ссылки через цикл -->
        <?php for($i = 0; $i < count($data['links']); $i++):?>
            <div>
                <b>Длинная: </b><a href="<?=$data['links'][$i]['long_link']?>"><?=$data['links'][$i]['long_link']?></a><br>
                <b>Короткая: </b><a href="<?=$data['links'][$i]['long_link']?>"><?=$data['links'][$i]['short_link']?></a>
                <form action="/home" method="post">
                    <input type="hidden" name="link_id_delete" value="<?=$data['links'][$i]['id']?>">
                    <button class="btn" id="send">Удалить<i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
            <br>
        <?php endfor;?>
    </div>
    </body>
    </html>
    <?php require 'public/blocks/footer.php'?>
<?php endif; ?>