<?php

    $error_text = $_GET["error_text"];
    // echo $error_text;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <title>Document</title>
</head>
<body>
    
    <main>
        <section class="error">
            <p><?= $error_text ?></p>
        </section>

        <section class="link">
            <a href="../admin/students.php">Zpět na úvodní stranu administrace</a>
        </section>
    </main>


    <script src="../js/header.js"></script>
</body>
</html>