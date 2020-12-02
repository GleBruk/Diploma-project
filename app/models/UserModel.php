<?php
    require 'DB.php';

    class UserModel{
        private $login;
        private $email;
        private $pass;

        private $_db = null;

        public function __construct(){
            // Подключаемся к БД
            $this->_db = DB::getInstance();
        }

        public function setData($login, $email, $pass){
            // Устанавливаем данные из контроллера
            $this->login = $login;
            $this->email = $email;
            $this->pass = $pass;
        }

        public function validForm(){
            // Проводим валидацию

            $check_user = $this->checkUser($this->login);

            if(strlen($this->email) < 3) {
                return "Email слишком короткий";
            } else if (strlen($this->login) < 3)
                return "Логин слишком короткий";
            else if($check_user['login'] != '')
                return "Данный логин уже занят";
            else if (strlen($this->pass) < 3)
                return "Пароль не менее 3 символов";
            else
                return "Верно";
        }

        public function addUser(){
            // Добавляем пользователя в БД

            $sql = 'INSERT INTO users(login, email, pass) VALUES(:login, :email, :pass)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute(['login' => $this->login, 'email' => $this->email, 'pass' => $pass]);

            // Устанавливаем куки и переадресовываем в личный кабинет пользователя
            $this->setAuth($this->login);
        }

        public function checkUser($login){
            // Возвращаем данные пользователя из БД по логину указанному в аргументе в виде
            // одномерного массива
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getUser(){
            // Возвращаем данные пользователя из БД логину взятому из куки, в виде
            // одномерного массива
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function logOut(){
            // Удаляем элемент login из куки и переадресовываем пользователя на авторизацию
            setcookie('login', $this->login, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: auth');
        }

        public function auth($login, $pass){
            //Берём данные пользователя из БД по указанному в форме логину, в виде одномерного
            // массива
            $user = $this->checkUser($login);

            // Проверяем введённые пользователем данные. Если данные введены верно, то
            // устанавливаем куки и переадресовываем пользователя в личный кабинет. Иначе
            // выводим ошибку
            if($user['login'] == '')
                return 'Пользователя с таким логином не существует';
            else if(password_verify($pass, $user['pass'])) {
                $this->setAuth($login);
            }
            else
                return 'Пароли не совпадают';
        }

        public function setAuth($login){
            //Устанавливаем куки и переадресовываем пользователя в личный кабинет.
            setcookie('login', $login, time() + 3600 * 24 * 7, '/');
            header('Location: /user/dashboard');
        }
    }