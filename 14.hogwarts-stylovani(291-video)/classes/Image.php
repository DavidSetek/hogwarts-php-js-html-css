<?php

class Image {

    public static function insertImage($conn, $user_id, $image_name){
        $sql = "INSERT INTO image (user_id, image_name)
                VALUES (:user_id, :image_name)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }
    }

    public static function getImagesByUserId($conn, $user_id){

        $sql = "SELECT image_name
                FROM image
                WHERE user_id = :user_id";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    public static function deletePhotoFromDirectory($path){
        try {
            // Kontrola existence souboru
            if(!file_exists($path)){
                throw new Exception("Soubor neexistuje a proto nemůže být smazán");
            }

            // Smazání souboru
            if(unlink($path)){
                return true;
            } else {
                throw new Exception("Při mazání souboru došlo k chybě");
            }
        } catch (Exception $e) {
            echo "Chyba: " . $e->getMesssage();
        }
    }

    
    public static function deletePhotoFromDatabase($conn, $image_name){
        $sql = "DELETE FROM image
                WHERE image_name = :image_name";
        
        $stmt = $conn->prepare($sql);

        try {
            $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

            if (!$stmt->execute()){
                throw new Exception("Obrázek se nepodařilo smazat z databáze");
            }

        } catch (Exception $e) {
            echo "Chyba: " . $e->getMessage();
        }
    }


}