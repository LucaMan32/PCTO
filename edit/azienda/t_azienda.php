<?php
	
	if(empty($_SESSION["email"])) 
		echo "<script type='text/javascript'>
			var richiesta = window.alert('Non disponibile senza login');
			window.location='http://localhost/project/index/login.html';
			</script>";

	if(strpos($_SESSION["email"],"@coordinatore.edu.it")==false)
		echo "<script type='text/javascript'>
			var richiesta = window.alert('Non dispone delle giuste autorizzazioni');
			window.location='http://localhost/project/print/page.php';
			</script>";

	$mysqli = new mysqli('127.0.0.1', 'root', '', 'pcto') or die(mysqli_error($mysqli));
	    
	$update = false;    
	$NomeA = '';
	$N_Telefono = '';
	$Email = '';
	$Indirizzo = '';
	$Città = '';
	$Tipo = '';

	if (isset($_GET['delete']))
	{
		$NomeA = $_GET['delete'];
		$mysqli->query("DELETE FROM azienda WHERE NomeA='$NomeA'") or die($mysqli->error());

		$_SESSION['message'] = "Azienda eliminata";
		$_SESSION['msg_type'] = "danger";

		header("location: c_azienda.php");
	}

	if (isset($_GET['edit']))
	{
		$NomeA = $_GET['edit'];
		$update = true;
		$resulta = $mysqli->query("SELECT * FROM azienda WHERE NomeA='$NomeA'") or die ($mysqli->error());
		if(is_countable($resulta)==1)
		{
			$row = $resulta->fetch_array();
			$NomeA = $row['NomeA'];
			$N_Telefono = $row['N_Telefono'];
			$Email = $row['Email'];
			$Indirizzo = $row['Indirizzo'];
			$Città = $row['Città'];
			$Tipo = $row['Tipo'];
		}
	}

	if (isset($_POST['update']))
	{
		$NomeA = $_POST['NomeA'];
		$N_Telefono = $_POST['N_Telefono'];
		$Email = $_POST['Email'];
		$Indirizzo = $_POST['Indirizzo'];
		$Città = $_POST['Città'];
		$Tipo = $_POST['Tipo'];
		
		$mysqli->query("UPDATE azienda SET NomeA='$NomeA', N_Telefono='$N_Telefono', Email='$Email', Indirizzo='$Indirizzo', Città='$Città', Tipo='$Tipo' WHERE NomeA='$NomeA'") or die($mysqli->error());

		$_SESSION['message'] = "Record updated";
		$_SESSION['msg_type'] = "warning";

		header("location: c_azienda.php");
	}

?>
