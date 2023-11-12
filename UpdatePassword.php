<?php
require_once("./Database.php");

if (!SessionManager::isAdmin()) {
    header("Location: ./index.php");
    exit();
}

if(!empty($_POST["id"]) && !empty($_POST["newPassword"])){

    $db = new Database();
    $login = $db->updatePasswordById($_POST["id"], $_POST["newPassword"]);
    $db->closeConnection();

    header("Location: ./edituser.php");
    exit();
}

header("Location: ./adminpanel.php");
exit();
?>