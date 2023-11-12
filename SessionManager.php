<?php
session_start();

class SessionManager{
    public static function isUserTypeSet() {
        return isset($_SESSION['userType']);
    }
    
    public static function isAdmin() {
        return self::isUserTypeSet() && $_SESSION['userType'] === 0;
    }
    
    public static function isUser() {
        return self::isUserTypeSet() && $_SESSION['userType'] === 1;
    }
    
    public static function isLogged() {
        return self::isAdmin() || self::isUser();
    }

    public static function logout(){
        unset($_SESSION['userID']);
        unset($_SESSION['userType']);
    }
}
?>