<?php
    require_once("./SessionManager.php");
    SessionManager::logout();
    header("Location: ./index.php");
?>