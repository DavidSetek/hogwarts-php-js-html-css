<?php

/**
 * 
 * Přidání uživatele do databáze
 * 
 * @param object $connection - připojení do databáze
 * @param string $first_name - křestní jméno uživatele
 * @param string $second_name - příjmení uživatele
 * @param string $email - email uživatele
 * @param string $password - heslo uživatele
 * 
 * @return integer $id - id uživatele
 */
function createUser($connection, $first_name, $second_name, $email, $password) {

    $sql = "INSERT INTO user (first_name, second_name, email, password) 
    VALUES (?, ?, ?, ?)";

    $statement = mysqli_prepare($connection, $sql);

    if ($statement === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($statement, "ssss", $first_name, $second_name, $email, $password);

        mysqli_stmt_execute($statement);
        $id = mysqli_insert_id($connection);
        return $id;
    }
}


/**
 * Ověření uživatele pomocí emailu a hesla
 *
 *
 * @param object $connection - připojení do databáze
 * @param string $log_email - email z formuláře pro přihlášení
 * @param string $log_password - heslo z formuláře pro přihlášení
 *
 * @return boolean true - pokud je přihlášení úspěšné, false - pokud je neúspěšné
 *
 */
function authentication($connection, $log_email, $log_password) {
    $sql = "SELECT password
            FROM user
            WHERE email = ?";
   
    $stmt = mysqli_prepare($connection, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $log_email);

        if (mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            // var_dump($result);

            if($result->num_rows != 0){
                $password_database = mysqli_fetch_row($result); // zde je v proměnné pole
                $user_password_database = $password_database[0]; // zde je v proměnné string

                if($user_password_database) {
                    return password_verify($log_password, $user_password_database);
                }
            } else {
                echo "Chyba při zadávání emailu";
            }
        }

    } else {
        echo mysqli_error($connection);
    }
}




/**
 * 
 * Získání ID uživatele
 * 
 * @param object $connection - připojení do databáze
 * @param string $email - email uživatele
 * 
 * @return int id uživatele
 * 
 */
function getUserId($connection, $email){
    $sql = "SELECT id FROM user
            WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $email);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $id_database = mysqli_fetch_row($result); // pole
            $user_id = $id_database[0];

            return $user_id;
        }

    } else {
        echo mysqli_error($connection);
    }
}