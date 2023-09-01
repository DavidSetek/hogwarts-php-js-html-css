<?php

class Student {

    public static function getStudent($connection, $id, $columns = "*") {
        $sql = "SELECT $columns
                FROM student
                WHERE id = :id";
        
        // $stmt = mysqli_prepare($connection, $sql);
        $stmt = $connection->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($connection);
        } else {
            // mysqli_stmt_bind_param($stmt, "i", $id);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return $stmt->fetch();
            }
        }
    }


    public static function updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id){

        $sql = "UPDATE student
                    SET first_name = :first_name,
                        second_name = :second_name,
                        age = :age,
                        life = :life,
                        college = :college
                    WHERE id = :id";
        
        // $stmt = mysqli_prepare($connection, $sql);
        $stmt = $connection->prepare($sql);

        if (!$stmt) {
                echo mysqli_error($connection);
        } else {
            // mysqli_stmt_bind_param($stmt, "ssissi", $first_name, $second_name, $age, $life, $college, $id);
            $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
            $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
            $stmt->bindValue(":age", $age, PDO::PARAM_INT);
            $stmt->bindValue(":life", $life, PDO::PARAM_STR);
            $stmt->bindValue(":college", $college, PDO::PARAM_STR);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return true;
            }
        }
    }


    public static function deleteStudent($connection, $id){
        $sql = "DELETE
                FROM student
                WHERE id = :id";
        
        // $stmt = mysqli_prepare($connection, $sql);
        $stmt = $connection->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($connection);
        } else {
            // mysqli_stmt_bind_param($stmt, "i", $id);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
        }
    }


    public static function getAllStudents($connection, $columns = "*"){
        $sql = "SELECT $columns 
                FROM student";

        // $result = mysqli_query($connection, $sql);
        $stmt = $connection->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // if ($result === false) {
        //     echo mysqli_error($connection);
        // } else {
        //     $allStudents = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //     return $allStudents;    
        // }
    }


    public static function createStudent($connection, $first_name, $second_name, $age, $life, $college) {

        $sql = "INSERT INTO student (first_name, second_name, age, life, college) 
        VALUES (:first_name, :second_name, :age, :life, :college)";

        // $statement = mysqli_prepare($connection, $sql);
        $stmt = $connection->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($connection);
        } else {
            // mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $college);
            $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
            $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
            $stmt->bindValue(":age", $age, PDO::PARAM_INT);
            $stmt->bindValue(":life", $life, PDO::PARAM_STR);
            $stmt->bindValue(":college", $college, PDO::PARAM_STR);

            if($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } 
            // else {
            //     echo mysqli_stmt_error($statement);
            // }
        }
    }

}