<?php

    // require "../assets/database.php";
    // require "../assets/zak.php";
    // require "../assets/auth.php";
    require "../classes/Database.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if ( !Auth::isLoggedIn() ){
        die("Nepovolený přístup");
    }

    // $connection = connectionDB();
    $database = new Database();
    $connection = $database->connectionDB();

    if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
        $students = Student::getStudent($connection, $_GET["id"]);
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

    <link rel="stylesheet" href="../css/admin-one-student.css">
    <title>Document</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

<main>
    <!-- <section class="main-heading">
        <h1>Informace o žákovi</h1>
    </section> -->

    <section class="one-student">
        <?php if ($students === null): ?>
            <p>Žák nenalezen</p>
        <?php else: ?>
            <div class="one-student-box">
                <h2><?= htmlspecialchars($students["first_name"]). " " .htmlspecialchars($students["second_name"]) ?></h2>
                <p>Věk: <?= htmlspecialchars($students["age"]) ?></p>
                <p>Dodatečné informace: <?= htmlspecialchars($students["life"]) ?></p>
                <p>Kolej: <?= htmlspecialchars($students["college"]) ?></p>
            </div>
            <div class="one-student-buttons">
                <a class="edit-one-student" href="edit-student.php?id=<?= $students['id'] ?>">Editovat</a>
                <a class="delete-one-student" href="delete-student.php?id=<?= $students['id'] ?>">Vymazat</a>
            </div>
        <?php endif ?>    
    </section>

    <!-- <section class="buttons">
            
    </section>         -->

</main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>