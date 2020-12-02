<?php
    require 'DB.php';

    class LinksModel{
        private $long_link;
        private $short_link;

        private $_db = null;

        public function __construct(){
        // Подключаемся к БД
            $this->_db = DB::getInstance();
        }

        public function setData($long_link, $short_link){
        // Устанавливаем данные
            $this->long_link = $long_link;
            $this->short_link = $short_link;
        }

        public function validLinks(){
        // Проводим валидацию

            $check = $this->getOneLink();

            if($this->long_link == '') {
                return "Введите длинную ссылку";
            } else if ($this->short_link == '')
                return "Введите короткую ссылку";
            elseif ($check['short_link'] == $this->short_link)
                return "Такое сокращение уже используется в базе";
            else
                return "Верно";
        }

        public function sendLinks(){
        // Добавляем ссылки в БД

            $user = $this->getUser();
            $user_id = $user['id'];

            $sql = 'INSERT INTO links(long_link, short_link, user_id) VALUES(:long_link, :short_link, :user_id)';
            $query = $this->_db->prepare($sql);

            $query->execute(['long_link' => $this->long_link, 'short_link' => $this->short_link, 'user_id' => $user_id]);
        }

        public function getLinks(){
        // Возвращаем данные ссылок из БД по id пользователя в виде двумерного массива
            $user = $this->getUser();
            $user_id = $user['id'];

            $result = $this->_db->query("SELECT * FROM `links` WHERE `user_id` = '$user_id'");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUser(){
        // Возвращаем данные пользователя из БД по логину пользователя взятому из куки,
        // в виде одномерного массива
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getOneLink() {
        // Берём данные ссылки и возвращаем в виде одномерного массива
            $result = $this->_db->query("SELECT * FROM `links` WHERE 
`short_link` = '$this->short_link'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteLink($link_id){
        // Удаляем ссылку из БД по id взятому из аргумента
            $result = $this->_db->query("DELETE FROM `links` WHERE `id` = '$link_id'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }