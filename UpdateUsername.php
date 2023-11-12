<?php
require_once("./Database.php");

if (!SessionManager::isAdmin()) {
    header("Location: ./index.php");
    exit();
}

if(!empty($_POST["id"]) && !empty($_POST["newUsername"])){

    $db = new Database();
    $login = $db->updateUsernameById($_POST["id"], $_POST["newUsername"]);
    $db->closeConnection();

    header("Location: ./edituser.php");
    exit();
}
?>