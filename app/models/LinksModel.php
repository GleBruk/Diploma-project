<?php
    require 'DB.php';

    class LinksModel{
        private $long_link;
        private $short_link;

        private $_db = null;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function setData($long_link, $short_link){
            $this->long_link = $long_link;
            $this->short_link = $short_link;
        }

        public function validLinks(){
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
            $user = $this->getUser();
            $user_id = $user['id'];

            $sql = 'INSERT INTO links(long_link, short_link, user_id) VALUES(:long_link, :short_link, :user_id)';
            $query = $this->_db->prepare($sql);

            $query->execute(['long_link' => $this->long_link, 'short_link' => $this->short_link, 'user_id' => $user_id]);
        }

        public function getLinks(){
            $user = $this->getUser();
            $user_id = $user['id'];

            $result = $this->_db->query("SELECT * FROM `links` WHERE `user_id` = '$user_id'");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUser(){
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getOneLink() {
            $result = $this->_db->query("SELECT * FROM `links` WHERE `short_link` = '$this->short_link'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteLink($link_id){
            $result = $this->_db->query("DELETE FROM `links` WHERE `id` = '$link_id'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }