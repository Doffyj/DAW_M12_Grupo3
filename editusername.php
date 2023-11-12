<?php
require_once("./Database.php");

if (!SessionManager::isAdmin()) {
    header("Location: ./index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ./adminpanel.php");
    exit();
}

$userId = $_GET['id'];
$db = new Database();
$userData = $db->getUserDataById($userId);
$db->closeConnection();

if (!$userData) {
    header("Location: ./adminpanel.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Edit Username</title>
</head>
<body>
    <div class="wrapper">
        <div>
            <strong> Current username: </strong>
            <span><?php echo $userData['name']; ?></span>
        </div>
        <div>
            <form action="UpdateUsername.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                <input type="text" class="logininput" name="newUsername" placeholder="new username">
                <input type="submit" class="btn btn-primary" id="loginbutton" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
