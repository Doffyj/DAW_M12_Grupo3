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
    <title>Edit User</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Edit User</a>
            <small class="text-light"><a href="logout.php">Log Out</a></small>
        </div>
    </nav>
    <div class="wrapper">
        <div>
            <strong>Username: </strong>
            <span><?php echo $userData['name']; ?></span>
            <a href="editusername.php?id=<?php echo $userId; ?>"><img class="edit-icon" src="./assets/editicon.png" alt=""></a>
        </div>
        <div>
            <strong>Password: </strong>
            <span>********</span>
            <a href="editpassword.php?id=<?php echo $userId; ?>"><img class="edit-icon" src="./assets/editicon.png" alt=""></a>
        </div>

    </div>
</body>
</html>
