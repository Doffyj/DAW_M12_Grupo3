<?php
    require_once("./Database.php");

    if (!SessionManager::isAdmin()){
        header("Location: ./index.php");
        exit();
    }

    if (!isset($_GET['id'])) {
        header("Location: ./adminpanel.php");
        exit();
    }

    $userId = $_GET['id'];
    $db = new Database();
    $db->deleteUserById($userId);
    $db->closeConnection();

    header("Location: ./adminpanel.php");
    exit();
?>