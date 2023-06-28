<?php

    require "assets/database.php";
    require "assets/zak.php";

    $connection = connectionDB();
    $students = getAllStudents($connection, "id, first_name, second_name");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Seznam žáků školy</h1>
        </section>

        <section class="students-list">
            <?php if(empty($students)): ?>
                <p>Žádní žáci nebyli nalezeni</p>
            <?php else: ?>
                <ul>
                    <?php foreach($students as $one_student): ?>
                        <li>
                            <?php echo htmlspecialchars($one_student["first_name"]). " " .htmlspecialchars($one_student["second_name"]) ?>
                        </li>
                        <a href="jeden-zak.php?id=<?= $one_student['id'] ?>">Více informací</a>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <a href="index.php">Zpět na úvodní stranu</a>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>
    
</body>
</html>
