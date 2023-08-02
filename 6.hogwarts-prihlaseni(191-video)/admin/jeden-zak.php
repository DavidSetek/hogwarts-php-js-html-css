<?php

    require "../assets/database.php";
    require "../assets/zak.php";
    require "../assets/auth.php";

    session_start();

    if ( !isLoggedIn() ){
        die("Nepovolený přístup");
    }

    $connection = connectionDB();

    if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
        $students = getStudent($connection, $_GET["id"]);
    } else {
        $students = null;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Informace o žákovi</h1>
        </section>

         <section>
            <?php if ($students === null): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?= htmlspecialchars($students["first_name"]). " " .htmlspecialchars($students["second_name"]) ?></h2>
                <p>Věk: <?= htmlspecialchars($students["age"]) ?></p>
                <p>Dodatečné informace: <?= htmlspecialchars($students["life"]) ?></p>
                <p>Kolej: <?= htmlspecialchars($students["college"]) ?></p>
            <?php endif ?>    
        </section>

        <section class="buttons">
                <a href="editace-zaka.php?id=<?= $students['id'] ?>">Editovat</a>
                <a href="delete-zak.php?id=<?= $students['id'] ?>">Vymazat</a>
        </section>        

    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>