<small style="float:right"><a href="logout.php">Log Out</a></small>
<?php
    require_once("./database.php");
	function echar(){
		echo '<script>alert("No tiene permisos para acceder a esta página.")</script>';
        header("Location: ./index.php");
	}
    if (isset($_SESSION['userID']) && isset($_SESSION['userType'])){
        if ($_SESSION['userType'] == 1){
			echar();
		}
		else
			echo '<script>alert("Bienvenido administrador!")</script>';
    }
    else{
		echar();
    }
?>
