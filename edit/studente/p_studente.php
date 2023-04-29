<?php
error_reporting (0);


session_start();

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


	$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
	    
	$update = false;    
	$Matricola = '';
	$Classe = '';
	$Cod_Fiscale = '';
	$Nome = '';
	$Cognome = '';
	$Data_Nascita = '';
	$OrePCTO = '';

	    if(isset($_POST['save']))
	    {
	    	$Matricola = $_POST['Matricola'];
	    	$Classe = $_POST['Classe'];
	    	$Cod_Fiscale = $_POST['Cod_Fiscale'];
	    	$Nome = $_POST['Nome'];
	    	$Cognome = $_POST['Cognome'];
	    	$Data_Nascita = $_POST['Data_Nascita'];
	    	$OrePCTO = $_POST['OrePCTO'];

	    	$mysqli->query("INSERT INTO studente (Matricola, Classe, Cod_Fiscale, Nome, Cognome, Data_Nascita, OrePCTO) VALUES('$Matricola', '$Classe', '$Cod_Fiscale', '$Nome', '$Cognome', '$Data_Nascita', '$OrePCTO')") or 
	    		die($mysqli->error);

	   		$_SESSION['message'] = "Studente salvato";
	   		$_SESSION['msg_type'] = "success";

	   		header("location: i_studente.php");
	    }

	    if (isset($_GET['delete']))
	    {
	    	$Matricola = $_GET['delete'];
	    	$mysqli->query("DELETE FROM studente WHERE Matricola=$Matricola") or die($mysqli->error());

	    	$mysqli->query("DELETE FROM corso WHERE Matricola=$Matricola") or die($mysqli->error());
	    	$mysqli->query("DELETE FROM stage WHERE Matricola=$Matricola") or die($mysqli->error());

	    	$_SESSION['message'] = "Studente eliminato";
	    	$_SESSION['msg_type'] = "danger";

	    	header("location: i_studente.php");
	    }

	    if (isset($_GET['edit']))
	    {
	    	$Matricola = $_GET['edit'];
	    	$update = true;
			$result = $mysqli->query("SELECT * FROM studente WHERE Matricola=$Matricola") or die ($mysqli->error());
	    	if(is_countable($result)==1)
	    	{
	    		$row = $result->fetch_array();
	    		$Matricola = $row['Matricola'];
	    		$Classe = $row['Classe'];
		    	$Cod_Fiscale = $row['Cod_Fiscale'];
	   	 		$Nome = $row['Nome'];
	    		$Cognome = $row['Cognome'];
	    		$Data_Nascita = $row['Data_Nascita'];
	    		$OrePCTO = $row['OrePCTO'];
	    	}
	    }

	    if (isset($_POST['update']))
	    {
	    	$Matricola = $_POST['Matricola'];
	    	$Classe = $_POST['Classe'];
		   	$Cod_Fiscale = $_POST['Cod_Fiscale'];
	   	 	$Nome = $_POST['Nome'];
	   		$Cognome = $_POST['Cognome'];
	   		$Data_Nascita = $_POST['Data_Nascita'];
	   		$OrePCTO = $_POST['OrePCTO'];
	    	
	    	$mysqli->query("UPDATE studente SET Matricola='$Matricola', Classe='$Classe', Cod_Fiscale='$Cod_Fiscale', Nome='$Nome', Cognome='$Cognome', Data_Nascita='$Data_Nascita', OrePCTO='$OrePCTO' WHERE Matricola=$Matricola") or die($mysqli->error);

	    	$_SESSION['message'] = "Record updated";
	    	$_SESSION['msg_type'] = "warning";

	    	header("location: i_studente.php");
	    }
?>