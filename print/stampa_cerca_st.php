<?php
	
	session_start();

	if(empty($_SESSION["email"])) 
        echo "<script type='text/javascript'>
		   var richiesta = window.alert('Non disponibile senza login');
		   window.location='http://localhost/project/index/login.html';
		   </script>";

?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body>

		<div align="center" class="barra"><br>&nbsp&nbsp
			<div class="aP">
				<a href="http://localhost/project/print/page.php?" title="Home"><img src="img/home.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/print/stampa_stage.php?" title="Torna indietro"><img src="img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/edit/stage/i_stage.php" title="Modifica alunno"><img src="img/modifica.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/index/logout.php?" title="Esci"><img src="img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
			</div> 
		</div> 

		<center>
			<div style ="float: center">
				<center>
			<h1><b>STAGE</b></h1>
		</center>

		<form action="stampa_cerca_st.php" method="GET">
			<input type="text" name="Cognome" placeholder="Cognome">
			<input type="text" name="Matricola" placeholder="Matricola">
			<input type="text" name="Azienda" placeholder="Azienda">
			<input type="text" name="Ore" placeholder="OreMax">
			<input type="text" name="Città" placeholder="Città">
			<select name="Tipo">
				<option value="">--Tipo Azienda--</option>
				<option value="Informatica">Informatica</option>
				<option value="Elettronica">Elettronica</option>
				<option value="Meccanica">Meccanica</option>
				<option value="Grafica">Grafica</option>
				<option value="Altro">Altro</option>
			</select>
			<input type="SUBMIT" value="Cerca">
			<input type="RESET" value="Azzera filtri">
			</center>
		</form>
	  
		</div>
		</center>
		<div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>ELENCO <b></b></h2>
							</div>
							<div class="col-sm-6">			
							</div>
						</div>
					</div>
		<?php
			$cognome = $_GET['Cognome'];
			$azienda = $_GET['Azienda'];
			$matricola = $_GET['Matricola'];
			$ore = $_GET['Ore'];
			$citta = $_GET['Città'];
			$tipo = $_GET['Tipo'];

			$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));

	    	if($cognome==NULL)
	    		if($azienda==NULL)
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							echo "<SCRIPT LANGUAGE='JavaScript'>
		                                window.alert('Devi completare almeno un campo!');
		                                window.location='stampa_stage.php';
		                                </SCRIPT>";	  
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    								$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Durata <= '$ore' AND Tipo= '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{

	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Durata <= '$ore' AND Città = '$citta'";
	    						}
	    						else
	    						{

	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Durata <= '$ore' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe, stage.Matricola
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola'";
	    						}
	    						else
	    						{

	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA, studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{

	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND OrePCTO <= '$ore' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND OrePCTO <= '$ore' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND OrePCTO <= '$ore' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    		else
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND Tipo= '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE azienda.NomeA = '$azienda' AND Città= '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE azienda.NomeA = '$azienda' AND Città= '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND OrePCTO <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE azienda.NomeA = '$azienda' AND OrePCTO <= '$ore' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE azienda.NomeA = '$azienda' AND OrePCTO <= '$ore' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND OrePCTO <= '$ore' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Città = '$citta'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo =  '$tipo'";
	    						}
	    					else
	    						if($tipo=NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    	else
	    		if($azienda==NULL)
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    						    $sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND Durata <= '$ore' AND Tipo = '$tipo'";	
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola'";	
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Tipo = '$tipo'";	
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Città = '$citta' AND Tipo = $tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Durata <= '$ore'";	
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo'";	
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta'";	
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Cognome = '$cognome' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta' AND Tipo = '$tipo'";	
	    						}
	    		else
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND NomeA = '$azienda'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND Durata <= '$ore' AND Tipo = '$tipo'";
	    						}
	    			else
	    			    if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda' AND studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo";
	    						}

	    
	    	if($cognome==NULL)
	    		if($azienda==NULL)
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							echo "<SCRIPT LANGUAGE='JavaScript'>
		                                window.alert('Devi completare almeno un campo!');
		                                window.location='stampa_stage.php';
		                                </SCRIPT>";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND Tipo = '$tipo'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND Tipo = '$tipo'";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Città = '$citta'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND Città = '$citta";
	    						}
	    		else
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome = '$cognome' AND azienda.NomeA = '$azienda'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Matricola = '$matricola' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Anno = '$anno' AND studente.Matricola = '$matricola' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta'  AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome = '$cognome'";
	    						}
	    	else
	    		if($azienda==NULL)
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Tipo = '$tipo' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Città = '$citta' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND Tipo = '$tipo' AND Cognome='$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND Tipo = '$tipo' AND Cognome='$cognome'";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Città = '$citta' AND Cognome='$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND Città = '$citta' AND Cognome='$cognome'";
	    						}
	    		else
	    			if($matricola==NULL)
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Città = '$citta' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE Durata <= '$ore' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Durata <= '$ore' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome='$cognome''";
	    						}
	    			else
	    				if($ore==NULL)
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE Anno = '$anno' AND studente.Matricola = '$matricola' AND Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    				else
	    					if($citta==NULL)
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    					else
	    						if($tipo==NULL)
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA 
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Città = '$citta'  AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}
	    						else
	    						{
	    							$sql = "SELECT studente.Matricola, studente.Nome, studente.Cognome, stage.Cod_Stage, azienda.NomeA,    studente.OrePCTO, stage.Durata, azienda.Città, stage.Anno, azienda.N_Telefono, azienda.Tipo, studente.Classe
	                                    FROM studente  JOIN stage ON studente.Matricola = stage.Matricola
	                                    JOIN azienda ON azienda.NomeA = stage.NomeA
	                                    WHERE studente.Matricola = '$matricola' AND Durata <= '$ore' AND Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA = '$azienda' AND Cognome='$cognome'";
	    						}

	    	$result = $mysqli->query($sql);
			if($result->num_rows)
			{  
					echo "<center>";

				echo "<table width='100%' border='0'>
					<tr>
						<th width='100' align='center'>CODICE STAGE</th>
						<th width='100' align='center'>ANNO</th>
						<th width='100' align='center'>AZIENDA</th>
						<th width='100' align='center'>TIPO</th>
						<th width='100' align='center'>RECAPITO</th>
						<th width='100' align='center'>MATRICOLA</th>
						<th width='100' align='center'>ALUNNO</th>
						<th width='100' align='center'>CLASSE</th>
						<th width='100' align='center'>ORE SVOLTE</th>

					</tr>";

				while($row = $result->fetch_assoc())
				{
					echo "<tr>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Cod_Stage'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Anno'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['NomeA'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Tipo'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['N_Telefono'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Matricola'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Nome'] . " " . $row['Cognome'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Classe'] . "</td>";
					echo "<td  style='border-bottom: 1px solid #000000'align='left'>" . $row['Durata'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Nessun valore trovato!');
						window.location='stampa_stage.php';
						</SCRIPT>";
			}

			$result->free();
			$mysqli->close();

		?> 
	</div>        
	</div>
	</body>
</html>
