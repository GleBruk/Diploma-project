<?php
    class Contact extends Controller {
        public function index(){

            $data = [];
            if (isset($_POST['name'])){
                $mail = $this->model('ContactModel');
                $mail->setData($_POST['name'], $_POST['email'], $_POST['age'], $_POST['mess']);

                $isValid = $mail->validForm();
                if($isValid == "Верно")
                    $data['mess'] = $mail->sendMess();
                else
                    $data['mess'] = $isValid;
            }

            $this->view("contact/index", $data);
        }

    }