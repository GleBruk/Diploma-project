<header>
    <div class="container top-menu">
        <div class="nav">
            <a href="/">Главная</a>
            <a href="/about">Про нас</a>
            <a href="/contact">Контакты</a>
            <?php if($_COOKIE['login'] == ''):?>
                <a href="/user/auth">Войти</a>
            <?php else: ?>
                <a href="/user/dashboard">Личный кабинет</a>
            <?php endif; ?>
        </div>
    </div>
</header>