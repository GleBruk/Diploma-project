<?php
    class Contact extends Controller {
        public function index(){

            // Если передаются данные через форму, то вызываем модель Contact
            // и устанавливаем туда данные
            $data = [];
            if (isset($_POST['name'])){
                $mail = $this->model('ContactModel');
                $mail->setData($_POST['name'], $_POST['email'], $_POST['age'], $_POST['mess']);

                // Делаем валидацию. Если данные заполнены корректно, то
                // отправляем письмо, иначе выводим ошибку
                $isValid = $mail->validForm();
                if($isValid == "Верно")
                    $data['mess'] = $mail->sendMess();
                else
                    $data['mess'] = $isValid;
            }

            // Вызываем шаблон и передаём данные
            $this->view("contact/index", $data);
        }

    }