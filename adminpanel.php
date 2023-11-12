<?php
require_once("./SessionManager.php");

if (!SessionManager::isLogged()) {
    if (!SessionManager::isAdmin()){
		header("Location: ./index.php");
		exit();
    }
} else {
    header("Location: ./index.php");
	exit();
}

$db = new Database();
$userNamesAndIds = $db->getUserNamesAndIdsList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <small class="text-light"><a href="logout.php">Log Out</a></small>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>User List</h2>
        <ul class="list-group">
            <?php foreach ($userNamesAndIds as $userId => $username): ?>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <?php echo $username; ?>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-warning" role="button" href="edituser.php?id=<?php echo $userId; ?>">Edit</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-danger" role="button" href="deleteuser.php?id=<?php echo $userId; ?>">Delete</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>