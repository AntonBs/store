<?php


class User
{

    public static function register($name, $email, $password){
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) '
        . 'VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name',$name, PDO::PARAM_STR);
        $result->bindParam(':email',$email, PDO::PARAM_STR);
        $result->bindParam(':password',$password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Проверяет имя
     */
    public static function checkName($name){
        if (strlen($name) >= 2){
            return true;
        }
        return false;
    }

    /**
     * Проверка пароля
     */
    public static function checkPassword($password){
        if (strlen($password) >= 6){
            return true;
        }
        return false;
    }
    /**
     * Проверка email
     */
    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email){
        $db = Db::getConnection();
        // Подготовленый запрос, что бы избежать sql инъекций от гадов
        $sql = 'SELECT COUNT(*) FROM user WHERE  email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email',$email, PDO::PARAM_STR);
        $result->execute();


        if ($result->fetchColumn())
            return true;
          return false;

    }
}