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
	$Cod_Stage = '';
	$Durata = '';
	$Anno = '';   
	$NomeA = '';
	$Matricola = '';
	$verifica=0;

	    if(isset($_POST['save']))
	    {
	    	$Cod_Stage = $_POST['Cod_Stage'];
	    	$Durata = $_POST['Durata'];
	    	$Anno = $_POST['Anno'];
	    	$NomeA = $_POST['NomeA'];
	    	$Matricola = $_POST['Matricola'];

	    	/*("SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO FROM corso RIGHT JOIN studente ON studente.Matricola = corso.Matricola WHERE $DataEsame ORDER BY studente.matricola"); */
	    	
	    	$res = $mysqli->query("SELECT corso.DataEsame FROM corso RIGHT JOIN studente ON corso.Matricola = studente.Matricola WHERE studente.Matricola='$Matricola' ORDER BY studente.Matricola") or die($mysqli->error);

	    	while($row = $res->fetch_assoc())
	    	{
	    		$var = $row['DataEsame'];
	    	}
	    	//$pop=$res->fetch_array();

	    	if($var!=NULL) 
	    	{
	    		$mysqli->query("INSERT INTO stage (Cod_Stage, Durata, Anno, NomeA, Matricola) VALUES('$Cod_Stage', '$Durata', '$Anno', '$NomeA', '$Matricola')") or die($mysqli->error);
 
	    		$mysqli->query("UPDATE studente SET OrePCTO= OrePCTO+'$Durata' WHERE Matricola=$Matricola") or die($mysqli->error);

	    		$_SESSION['message'] = "Stage salvato";
	   			$_SESSION['msg_type'] = "success";
	    	}
	    	else
	    	{
	    		$_SESSION['message'] = "la matricola non ha fatto il corso";
	   			$_SESSION['msg_type'] = "success";
	    	}

	    	header("location: i_stage.php");	
	    }

	    if (isset($_GET['delete']))
	    {
	    	$Cod_Stage = $_GET['delete'];

	    	$mysqli->query("DELETE FROM stage WHERE Cod_Stage='$Cod_Stage'") or die($mysqli->error());
	    	$mysqli->query("UPDATE studente SET OrePCTO= OrePCTO-'$Durata' WHERE Matricola='$Matricola'") or die($mysqli->error);

	    	$_SESSION['message'] = "Stage eliminato";
	    	$_SESSION['msg_type'] = "danger";

	    	header("location: i_stage.php");
	    }

	    if (isset($_GET['edit']))
	    {
	    	$Cod_Stage = $_GET['edit'];
	    	$update = true;
			$result = $mysqli->query("SELECT * FROM stage WHERE Cod_Stage=$Cod_Stage") or die ($mysqli->error());
	    	if(is_countable($result)==1)
	    	{
	    		$row = $result->fetch_array();
	    		$Cod_Stage = $row['Cod_Stage'];
	    		$Durata = $row['Durata'];
		    	$Anno = $row['Anno'];
	    		$NomeA = $row['NomeA'];
	    		$Matricola = $row['Matricola'];
	    	}
	    }

	    if (isset($_POST['update']))
	    {
	    	$Cod_Stage = $_POST['Cod_Stage'];
	    	$Durata = $_POST['Durata'];
	    	$Anno = $_POST['Anno'];
	    	$NomeA = $_POST['NomeA'];
	    	$Matricola = $_POST['Matricola'];

	    	if($Cod_Stage>=0 && $Durata>=0)
	    	{
				$mysqli->query("UPDATE stage SET Cod_Stage='$Cod_Stage', Durata='$Durata', Anno='$Anno', NomeA='$NomeA', Matricola='$Matricola' WHERE Cod_Stage=$Cod_Stage") or die($mysqli->error);
				if($Durata >= stage.Durata)
				{
					$Durata-=stage.Durata;
				
					$mysqli->query("UPDATE studente SET OrePCTO= OrePCTO+'$Durata' WHERE Matricola=$Matricola") or die($mysqli->error);

	    			$_SESSION['message'] = "Stage aggiornato";
	   				$_SESSION['msg_type'] = "warning";
	   			}
	   			else
	   			{
	   				$Durata-=stage.Durata;
	   				
	   				$mysqli->query("UPDATE studente SET OrePCTO= OrePCTO-'$Durata' WHERE Matricola=$Matricola") or die($mysqli->error);

	    			$_SESSION['message'] = "Stage aggiornato";
	   				$_SESSION['msg_type'] = "warning";
	   			}
	    	}
	    	else
	    	{
	    		$_SESSION['message'] = "Impossibile inserire valori negativi";
	   			$_SESSION['msg_type'] = "warning";
	    	}

	    	header("location: i_stage.php");
	    }
?>