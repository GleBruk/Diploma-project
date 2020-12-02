<?php
// Для отправки писем используем библиотеку PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    class ContactModel{

        private $name;
        private $email;
        private $age;
        private $mess;

        public function setData($name, $email, $age, $mess){
        // Устанавливаем данные из контроллера
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->mess = $mess;
        }

        public function validForm(){
        // Проводим валидацию
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
            // Создаём новый объект
            $mail = new PHPMailer(true);

            try {
                // Указываем данные для отправки письма
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
            $mail->Host       = 'smtp.sendgrid.net';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'username';
                $mail->Password   = 'password';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                // Устанавливаем email, имя и возраст отправителя
                $mail->setFrom("$this->email", "$this->name" . ', ' . "$this->age" . ' лет');

                // Устанавливаем email и имя получателя
                $mail->addAddress('gleb-ruksha@rambler.ru', 'Gleb');

                // Указываем тему сообщения и сообщение
                $mail->Subject = 'Сообщение с сайта';
                $mail->Body = $this->mess;

                // Указываем кодировку
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                // Отправляем сообщение
                $mail->send();
                // Если сообщение было отправлено, то выводим это. Иначе выводим ошибку
                return 'Сообщение было отправлено';
            } catch (Exception $e) {
                return "Сообщение не было отправлено. Ошибка: {$mail->ErrorInfo}";
            }
        }
    }
