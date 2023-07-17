<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/footer.css">

    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <main>
        <section class="registration-form">
            <form action="admin/after-registration.php" method="POST">
                <input type="text" name="first-name" placeholder="Křestní jméno"><br>
                <input type="text" name="second-name" placeholder="Příjmení"><br>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Heslo"><br>
                <input type="password" name="password-again" placeholder="Heslo znovu"><br>
                <input type="submit" value="Zaregistrovat">
            </form>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>
    <script src="./js/header.js"></script>
</body>
</html>