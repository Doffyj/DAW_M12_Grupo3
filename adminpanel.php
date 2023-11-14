<small style="float:right"><a href="logout.php">Log Out</a></small>
<?php
    require_once("./database.php");
    if (isset($_SESSION['userID']) && isset($_SESSION['userType'])){
        if ($_SESSION['userType'] == 1){
            header("Location: ./userview.php");
        }
    }
    else{
        header("Location: ./index.php");
    }
?>
