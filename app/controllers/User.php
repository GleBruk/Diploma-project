<?php


class User extends Controller {
    public function reg(){

        $data = [];
        if (isset($_POST['login'])){
            $user = $this->model('UserModel');
            $user->setData($_POST['login'], $_POST['email'], $_POST['pass']);

            $isValid = $user->validForm();
            if($isValid == "Верно")
                $user->addUser();
            else
                $data['message'] = $isValid;
        }

        $this->view('user/reg', $data);
    }

    public function dashboard() {

        $user = $this->model('UserModel');
        $data = ['user' => $user->getUser()];

        if(isset($_POST['exit_btn'])) {
            $user->logOut();
            exit();
        }

        $this->view('user/dashboard', $data);
    }

    public function auth(){

        $data = [];
        if(isset($_POST['login'])){
            $user = $this->model('UserModel');
            $data['message'] = $user->auth($_POST['login'], $_POST['pass']);
        }

        $this->view('user/auth', $data);
    }
}