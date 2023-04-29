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
		<meta charset="utf-8">
		<link href="../style.css" rel="stylesheet" type="text/css">
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
				<a href="http://localhost/project/print/stampa_corso.php?" title="Torna indietro"><img src="img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/edit/corso/i_corso.php" title="Modifica alunno"><img src="img/modifica.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/index/logout.php?" title="Esci"><img src="img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
			</div> 
		</div> 

    <?php
    	$codice = $_GET['Codice'];
	    $ore = $_GET['OreMax'];
	    $matricola = $_GET['Matricola'];
	    $azienda = $_GET['Azienda'];
	    $mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));

		if($codice==NULL)
			if($matricola==NULL)
				if($azienda==NULL)
					if($ore==NULL)
					{
						echo "<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Devi completare almeno un campo!');
							window.location='stampa_corso.php';
							</SCRIPT>";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.OreC <= '$ore'";
					}
				else
					if ($ore==NULL) 
					{
						$sql = "SELECT * FROM corso WHERE corso.NomeA = '$azienda'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.NomeA = '$azienda' AND corso.OreC <= '$ore'";
					}
			else
				if($azienda==NULL)
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.Matricola = '$matricola'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.Matricola = '$matricola' AND corso.OreC <= '$ore'";
					}
				else
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.NomeA = '$azienda' AND corso.Matricola = '$matricola'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.NomeA = '$azienda' AND corso.Matricola = '$matricola' AND corso.OreC <= '$ore'";
					}
		else
			if($matricola==NULL)
				if($azienda==NULL)
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND OreC <='$ore'";
					}
				else
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.NomeA='$azienda'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.NomeA='$azienda' AND corso.OreC <= '$ore'";
					}
			else
				if($azienda==NULL)
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.Matricola='$matricola'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.Matricola='$matricola' AND corso.OreC <='$ore'";
					}
				else
					if($ore==NULL)
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.Matricola='$matricola' AND corso.NomeA = '$azienda'";
					}
					else
					{
						$sql = "SELECT * FROM corso WHERE corso.Cod_Corso = '$codice' AND corso.Matricola='$matricola' AND corso.NomeA = '$azienda' AND corso.OrePCTO <= '$ore' ";
					}
			$result = $mysqli->query($sql); 
	?>

		<center>
			<h1><b>CORSO SICUREZZA</b></h1>
			<div style="float: center">
			<center>
			<form method="GET" action="stampa_cerca_corso.php">
				<input type="textarea" placeholder="Codice" name="Codice">
				<input type="textarea" placeholder="OreMax" name="OreMax">
				<input type="textarea" placeholder="Matricola" name="Matricola">
				<input type="textarea" placeholder="Azienda" name="Azienda">
				<input type="submit"   value="Cerca" name="cerca">
				<input type="reset"    value="Azzera filtri" name="annulla">
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
			if($result->num_rows)
			{
				echo "<center>";
				echo "<table border ='0' width='100%'>
					<tr>
						<th width='100'>CODICE CORSO</th>
						<th width='100'>NUMERO ORE</th>
						<th width='100'>DATA ESAME</th>
						<th width='100'>NOME AZIENDA</th>
						<th width='100'>MATRICOLA</th>
					<tr>";
				while($row = $result->fetch_assoc())
				{
				echo "<tr>";
				echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Cod_Corso'] . "</td>";
				echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['OreC'] . "</td>";
				$dataConvert = date_create($row['DataEsame']);
				$dataEurope = date_format($dataConvert ,'d/m/Y');
				echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $dataEurope . "</td>";
				echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['NomeA'] . "</td>";
				echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Matricola'] . "</td>";
				echo "</tr>";
				}

				echo "</table>";
			}
			else
			{
				echo "<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Nessun valore trovato!');
					window.location='stampa_corso.php';
					</SCRIPT>";
			}

			$result->free();
			$mysqli->close(); 
	    ?>
	</div>        
	</div>
	</body>
</html>
