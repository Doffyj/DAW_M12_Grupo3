<?php
require_once("./Database.php");

if (SessionManager::isLogged()) {
    header("Location: ./index.php");
    exit();
}

if(!empty($_POST["username"]) && !empty($_POST["password"])){

    $db = new Database();
    $db->addUser($_POST["username"], $_POST["password"]);
    $db->closeConnection();

    header("Location: ./index.php");
    exit();
}
?>