<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $database = new Database();
    $connection = $database->connectionDB();

    $log_email = $_POST["login-email"];
    $log_password = $_POST["login-password"];

    if(User::authentication($connection, $log_email, $log_password)) {
        // Získání ID uživatele
        $id = User::getUserId($connection, $log_email);

        // Zabraňuje provedení tzv. fixation attack. Více zde: https://owasp.org/www-community/attacks/Session_fixation
        session_regenerate_id(true);

        // Nastavení, že je uživatel přihlášený
        $_SESSION["is_logged_in"] = true;
        // Nastavení ID uživatele
        $_SESSION["logged_in_user_id"] = $id;
        // Nastavení role uživatele
        $_SESSION["role"] = User::getUserRole($connection, $id);

        Url::redirectUrl("/skola-projekt/admin/students.php");
        
    } else {
        $error = "Chyba při přihlášení";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!empty($error)): ?>
        <p><?= $error ?></p>
        <a href="../signin.php">Zpět na přihlášení</a>
    <?php endif; ?>
</body>
</html>

<!-- object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(1) ["lengths"]=> NULL ["num_rows"]=> int(1) ["type"]=> int(0) } -->
<!-- object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(1) ["lengths"]=> NULL ["num_rows"]=> int(0) ["type"]=> int(0) } -->