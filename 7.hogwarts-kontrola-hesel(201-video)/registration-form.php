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

    <link rel="stylesheet" href="css/registration-form.css">


    <title>Document</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <main>
        <section class="registration-form">
            <h1>Registrace</h1>
            <form action="admin/after-registration.php" method="POST">
                <input class="reg-input" type="text" name="first-name" placeholder="Křestní jméno"><br>
                <input class="reg-input" type="text" name="second-name" placeholder="Příjmení"><br>
                <input class="reg-input" type="email" name="email" placeholder="Email"><br>
                <input class="reg-input password-first" type="password" name="password" placeholder="Heslo"><br>
                <input class="reg-input password-second" type="password" name="password-again" placeholder="Heslo znovu"><br>
                <p class="result-text"></p>
                <input class="btn" type="submit" value="Zaregistrovat">
            </form>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>
    <script src="./js/header.js"></script>
    <script src="./js/passwordchecker.js"></script>
</body>
</html>