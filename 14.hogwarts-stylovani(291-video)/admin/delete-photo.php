<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Image.php";
    require "../classes/Url.php";

    session_start();

    // Ověření, zda je uživatel přihlášený
    if ( !Auth::isLoggedIn() ){
        die("Nepovolený přístup");
    }

    $db = new Database();
    $connection = $db->connectionDB();

    $user_id = $_GET["id"];
    $image_name = $_GET["image_name"];

    $image_path = "../uploads/" . $user_id . "/" . $image_name;
    
    if(Image::deletePhotoFromDirectory($image_path)){
        // Smazat obrázek z databáze
        Image::deletePhotoFromDatabase($connection, $image_name);
        Url::redirectUrl("/skola-projekt/admin/photos.php");
    }

