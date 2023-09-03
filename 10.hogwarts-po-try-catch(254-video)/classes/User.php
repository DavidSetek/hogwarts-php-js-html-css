<?php

class User {

    public static function createUser($connection, $first_name, $second_name, $email, $password) {

        $sql = "INSERT INTO user (first_name, second_name, email, password) 
        VALUES (:first_name, :second_name, :email, :password)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("Vytvoření uživatele selhalo"); 
            }
        } catch (Exception $e) {
            error_log("Chyba u funkce createUser\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }    
    }


    public static function authentication($connection, $log_email, $log_password) {
        $sql = "SELECT password
                FROM user
                WHERE email = :email";
    
        $stmt = $connection->prepare($sql);

      
        $stmt->bindValue(":email", $log_email, PDO::PARAM_STR);

        try {
            if($stmt->execute()){
                if ($user = $stmt->fetch()){
                    return password_verify($log_password, $user[0]);
                }
            } else {
                throw new Exception("Autentikace se nezdařila");
            }
        } catch (Exception $e) {
            error_log("Chyba u funkce authentication\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }  
    }


    public static function getUserId($connection, $email){
        $sql = "SELECT id FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);

        try {
            if($stmt->execute()){
                $result = $stmt->fetch();
                $user_id = $result[0];
                return $user_id;
            } else {
                throw new Exception("Získání ID uživatele selhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba u funkce getUserId\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }       
    }
}



