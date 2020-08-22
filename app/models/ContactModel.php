<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    class ContactModel{

        private $name;
        private $email;
        private $age;
        private $mess;

        public function setData($name, $email, $age, $mess){
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->mess = $mess;
        }

        public function validForm(){
            if(strlen($this->name) < 3){
                return "Имя слишком короткое";
            } else if (strlen($this->email) < 3)
                return "Email слишком короткий";
            else if (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                return "Вы ввели не возраст";
            else if (strlen($this->mess) < 10)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

        public function sendMess(){
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
            $mail->Host       = 'smtp.sendgrid.net';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'aleksandr-ivanov';
                $mail->Password   = 'password';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom("$this->email", "$this->name" . ', ' . "$this->age" . ' лет');

                $mail->addAddress('gleb-ruksha@rambler.ru', 'Gleb');

                $mail->Subject = 'Сообщение с сайта'; // Тема сообщения
                $mail->Body = $this->mess;

                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                $mail->send();
                return 'Сообщение было отправлено';
            } catch (Exception $e) {
                return "Сообщение не было отправлено. Ошибка: {$mail->ErrorInfo}";
            }
        }
    }
