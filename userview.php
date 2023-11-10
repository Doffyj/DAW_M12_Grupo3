<small style="float:right"><a href="logout.php">Log out</a></small>
<?php
	require_once("./database.php");
	if ((!isset($_SESSION['userID']) && !isset($_SESSION['userType'])) || ($_SESSION['userType'] != 0)){
		if ($_SESSION['userType'] == 1)
		{
			echo '<script>alert("Bienvenido administrador!")</script>';
		}
		else {
			echo '<script>alert("No tiene permisos para acceder a esta página.")</script>';
			header("Location: ./index.php");
		}
	}
	else{
		echo '<script>alert("Bienvenido usuario!")</script>';
	}
?>
