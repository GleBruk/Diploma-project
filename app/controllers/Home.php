<?php

    class Home extends Controller {

        public function index(){
            // Вызываем модель LinksModel
            $links = $this->model('LinksModel');

            // Если пользователь отправил ссылки, то устанавливаем их, проверяем и добавляем в БД
            if (isset($_POST['long_link'])){
                $links->setData($_POST['long_link'], $_POST['short_link'], $_COOKIE['login']);

                // Проводим валидацию
                $isValid = $links->validLinks();
                // Если данные введены корректно, то добавляем их в БД. Иначе выводим ошибку
                if($isValid == "Верно")
                    $links->sendLinks();
                else
                    $data['message'] = $isValid;
            }

            // Если пользователь нажал кнопку "Удалить", то удаляем ссылку
            if(isset($_POST['link_id_delete'])) {
                $links->deleteLink($_POST['link_id_delete']);
            }

            // Берём ссылки из БД
            $data['links'] = $links->getLinks();

            // Вызываем шаблон и передаём данные
            $this->view('home/index', $data);
        }
    }