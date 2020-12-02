<?php


class User extends Controller {
    public function reg(){

        $data = [];
        // Если передаются данные из формы, то вызываем модель UserModel и устанавливаем туда
        // данные
        if (isset($_POST['login'])){
            $user = $this->model('UserModel');
            $user->setData($_POST['login'], $_POST['email'], $_POST['pass']);

            //Проводим валидацию. Если форма заполнена корректно, то добавляем пользователя в БД.
            // Иначе выводим ошибку
            $isValid = $user->validForm();
            if($isValid == "Верно")
                $user->addUser();
            else
                $data['message'] = $isValid;
        }

        //Вызываем шаблон и передаём данные
        $this->view('user/reg', $data);
    }

    public function dashboard() {

        // Вызываем модель UserModel и устанавливаем данные пользователя для передачи в шаблон
        $user = $this->model('UserModel');
        $data = ['user' => $user->getUser()];

        // Если пользователь нажал кнопку 'Выйти', то удаляем элемент login из куки и
        // переадресовываем пользователя на авторизацию
        if(isset($_POST['exit_btn'])) {
            $user->logOut();
            exit();
        }

        // Вызываем шаблон и передаём данные
        $this->view('user/dashboard', $data);
    }

    public function auth(){

        $data = [];
        // Если передаются данные из формы, то вызываем модель UserModel и проверяем
        // введённые данные
        if(isset($_POST['login'])){
            $user = $this->model('UserModel');
            $data['message'] = $user->auth($_POST['login'], $_POST['pass']);
        }

        //Вызываем шаблон и передаём данные
        $this->view('user/auth', $data);
    }
}