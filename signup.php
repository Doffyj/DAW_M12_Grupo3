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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Signup</title>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="AddUser.php" id="loginform">
            <h1>Signup</h1>
            <input type="text" class="logininput" name="username" placeholder="username">
            <input type="password" class="logininput" name="password" placeholder="password">
            <input type="submit" class="btn btn-primary" id="loginbutton" value="Signup">
        </form>
    </div>
</body>
</html>