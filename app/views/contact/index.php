<?php require 'public/blocks/header.php'?>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Обратная связь</title>
        <meta name="description" content="Обратная связь">

        <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
        <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous" >
    </head>
    <body>
        <div class="container main">
            <h1>Обратная связь</h1>
            <p>Напишите, если у вас есть вопросы</p>
            <br>
            <form action="/contact" method="post" class="form-control">
                <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
                <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
                <input type="text" name="age" placeholder="Введите возраст" value="<?=$_POST['age']?>"><br>
                <textarea name="mess" cols="30" rows="10" placeholder="Введите само сообщение" value="<?=$_POST['mess']?>"></textarea>
                <div class="error"><?=$data['mess']?></div>
                <button class="btn" id="send">Отправить</button>
            </form>
        </div>
    </body>
</html>
<?php require 'public/blocks/footer.php'?>
