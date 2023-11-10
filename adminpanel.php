<small style="float:right"><a href="logout.php">Log Out</a></small>
<?php
    require_once("./database.php");
	function echar(int $st){
		echo '<script>alert("No tiene permisos para acceder a esta página.")</script>';
		if ($st == 0){
			header("Location: ./index.php");
		}
		else{
			header("Location: ./userview.php");
		}
	}
    if (isset($_SESSION['userID']) && isset($_SESSION['userType'])){
        if ($_SESSION['userType'] == 1){
			echar(1);
		}
		else
			echo '<script>alert("Bienvenido administrador!")</script>';
    }
    else{
		echar(0);
    }
?>
