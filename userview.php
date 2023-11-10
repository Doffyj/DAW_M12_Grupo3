<small style="float:right"><a href="logout.php">Log out</a></small>
<?php
	require_once("./database.php");
	if ((!isset($_SESSION['userID']) && !isset($_SESSION['userType'])) || ($_SESSION['userType'] != 0)){
		echo '<script>alert("No tiene permisos para acceder a esta página.")</script>';
		echo '<script>window.location="./index.php"</script>';
	}
	else{
		echo '<script>alert("Bienvenido usuario!")</script>';
	}
?>
