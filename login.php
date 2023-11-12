<?php
require_once("./Database.php");

if (SessionManager::isLogged()) {
    if (SessionManager::isAdmin()) {
        header("Location: ./adminpanel.php");
        exit();
    } else if (SessionManager::isUser()) {
        header("Location: ./userview.php");
        exit();
    }
} else if (!empty($_POST["username"]) && !empty($_POST["pass"])) {
    $db = new Database();
    $login = $db->validateUser($_POST["username"], $_POST["pass"]);
    $db->closeConnection();
}

header("Location: ./index.php");
exit();
?>