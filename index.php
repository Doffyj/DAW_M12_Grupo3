<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
    <form method="POST" id="loginform">
                <h1>Login</h1>

                <input type="text" class="logininput" name="username" placeholder="username">

                <input type="password" class="logininput" name="pass" placeholder="password">

                <input type="submit" id="loginbutton" value="Login">
            </form>
    </div>
    <?php
    require_once("./database.php");

    if (isset($_SESSION['userID']) && isset($_SESSION['userType'])){
        if ($_SESSION['userType'] == 0){
            header("Location: ./adminpanel.php");
        }
        else if ($_SESSION['userType'] == 1){
            header("Location: ./userview.php");
        }
    }

    if (!empty($_POST["username"]) && !empty($_POST["pass"])){
        $db = new Database();
        $login = $db->validateUser($_POST["username"], $_POST["pass"]);
        $db->closeConnection();

        if ($login){
            header("Refresh:0");
        }
    }
    ?>
</body>
</html>
