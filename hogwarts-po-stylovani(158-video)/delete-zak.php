<?php

require "assets/database.php";
require "assets/zak.php";

$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    deleteStudent($connection, $_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>
    <title>Smazat žáka</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <main>
        <section class="delete-form">
            <form method="POST">
                <p>Jste si jisti, že chcete tohoto žáka smazat?</p>
                <button>Smazat</button>
                <a href="jeden-zak.php?id=<?= $_GET['id'] ?>">Zrušit</a>
            </form>
        </section>
    </main>
   
    <?php require "assets/footer.php"; ?>
    <script src="./js/header.js"></script>
</body>
</html>




