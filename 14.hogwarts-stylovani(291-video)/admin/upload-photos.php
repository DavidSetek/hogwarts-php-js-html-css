<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Url.php";
    require "../classes/Image.php";

    session_start();

    // Ověření, zda je uživatel přihlášený
    if ( !Auth::isLoggedIn() ){
        die("Nepovolený přístup");
    }

    $user_id = $_SESSION["logged_in_user_id"]; // 2

    if(isset($_POST["submit"]) && isset($_FILES["image"])){

        $db = new Database();
        $connection = $db->connectionDB();

        var_dump($_FILES["image"]);

        $image_name = $_FILES["image"]["name"];
        $image_size = $_FILES["image"]["size"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];

        if ($error === 0){
            if ($image_size > 9000000){

                Url::redirectUrl("/skola-projekt/errors/error-page.php?error_text=Váš soubor je příliš veliký");

            } else {
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_extension_lower_case = strtolower($image_extension); 

                $allowed_extensions = ["jpg", "jpeg", "png"];

                if(in_array($image_extension_lower_case, $allowed_extensions)){
                    //sestavujeme unikátní název obrázku
                    $new_image_name = uniqid("IMG-", true) . "." . $image_extension; 

                    if(!file_exists("../uploads/" . $user_id)){
                        mkdir("../uploads/" . $user_id, 0777, true);
                    }
                    
                    $image_upload_path = "../uploads/" . $user_id . "/" . $new_image_name;
                    move_uploaded_file($image_tmp_name, $image_upload_path);

                    // Vložení obrázku do databáze
                    if(Image::insertImage($connection, $user_id, $new_image_name)){
                        Url::redirectUrl("/skola-projekt/admin/photos.php");
                    }

                } else {
                    Url::redirectUrl("/skola-projekt/errors/error-page.php?error_text=Koncovka vašeho souboru není povolená");
                }
            }
        } else {
            Url::redirectUrl("/skola-projekt/errors/error-page.php?error_text=Nahrání obrázku se bohužel nepodařilo");
        }
    }
    
?>