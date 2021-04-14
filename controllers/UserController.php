<?php


class UserController
{
    public function actionRegister()
    {
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)){
                $errors[] = 'Имя должно быть больше 2-х символов';
            }

            if (!User::checkEmail($email)){

                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)){
                $errors[] = 'Пароль больше 6-ти символов';
            }

            if (User::checkEmailExists($email)){
                $errors[] = 'Такой email уже используется';
            }

            if ($errors == false){
                $result = User::register($name, $email, $password) ;
            }
        }


        require_once (ROOT .'/views/user/register.php');

        return true;
    }

}