<?php

class Auth {
  
    public static function isLoggedIn(){
        return isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"];
    }

}