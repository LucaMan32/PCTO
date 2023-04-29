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
				<a href="http://localhost/project/print/stampa_al.php?" title="Torna indietro"><img src="img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/edit/studente/i_studente.php" title="Modifica alunno"><img src="img/modifica.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/index/logout.php?" title="Esci"><img src="img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
			</div> 
		</div> 

		<center>
			<h1><b>ALUNNI</b></h1>
		</center>

        <div style="float: center">
    	<center>
    	<form method="GET" action="stampa_cerca_al.php">
    		<input type="textarea" placeholder="Nome" name="Nome">
    		<input type="textarea" placeholder="Cognome" name="Cognome">
    		<input type="textarea" placeholder="Matricola" name="Matricola">
    		<input type="textarea" placeholder="Classe" name="Classe">
    		<input type="textarea" placeholder="Valore Max Ore" name="Ore">
    		<input type="submit"   value="Cerca" name="cerca">
    		<input type="reset"    value="Azzera filtri" name="annulla">
    	</form>
    	</div>
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
			$nome = $_GET['Nome'];
			$cognome = $_GET['Cognome'];
			$matricola = $_GET['Matricola'];
			$classe = $_GET['Classe'];
			$ore = $_GET['Ore'];
			$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));

			if($nome==NULL)
				if($cognome==NULL)
					if($matricola==NULL)
						if($classe==NULL)
							if($ore==NULL)
							{
								echo "<SCRIPT LANGUAGE='JavaScript'>
									window.alert('Devi completare almeno un campo!');
									window.location='stampa_al.php';
									</SCRIPT>";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola 
									WHERE studente.OrePCTO <='$ore' ORDER BY Matricola";
							}
						else
							if ($ore==NULL) 
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola WHERE studente.classe = '$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Classe = '$classe' AND studente.OrePCTO <= '$ore' ORDER BY Matricola";
							}
					else
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Matricola = '$matricola' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Classe = '$classe' AND studente.Matricola = '$matricola' AND studente.OrePCTO <= '$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE Classe = '$classe' AND studente.Matricola = '$matricola' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE Classe = '$classe' AND studente.Matricola = '$matricola' AND studente.OrePCTO <= '$ore' ORDER BY Matricola";
							}
				else
					if($matricola==NULL)
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.OrePCTO <='$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE Cognome = '$cognome' AND studente.Classe='$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.Classe='$classe' AND studente.OrePCTO <= '$ore' ORDER BY Matricola";
							}
					else
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.Matricola='$matricola' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.Matricola='$matricola' AND studente.OrePCTO <='$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Cognome = '$cognome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' AND studente.OrePCTO <= '$ore' ORDER BY Matricola";
							}
			else
				if($cognome==NULL)
					if($matricola==NULL)
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome = '$cognome' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Classe = '$classe' ORDER BY Matricola";	
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Classe = '$classe' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
					else
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Matricola='$matricola' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Matricola='$matricola' and studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
				else
					if($matricola==NULL)
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Classe='$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Classe='$classe' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
					else
						if($classe==NULL)
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Matricola='$matricola' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Matricola='$matricola' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}
						else
							if($ore==NULL)
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' ORDER BY Matricola";
							}
							else
							{
								$sql = "SELECT studente.Matricola, studente.Cognome, studente.Nome, studente.Classe, studente.Cod_Fiscale, studente.Data_Nascita, studente.OrePCTO, 
									corso.OreC, corso.DataEsame FROM corso RIGHT JOIN studente 
									ON studente.Matricola = corso.Matricola  WHERE studente.Nome = '$nome' AND studente.Cognome='$cognome' AND studente.Matricola='$matricola' AND studente.Classe = '$classe' AND studente.OrePCTO='<=$ore' ORDER BY Matricola";
							}

	    	$result = $mysqli->query($sql);
		?>

		<div style = "float: center">
			<center>
		
		<?php
			if($result->num_rows)
			{
				echo "<center>";
				echo "<table border ='0' width='100%'>
					<tr>
						<th width='100'>MATRICOLA</th>
						<th width='100'>COGNOME</th>
						<th width='100'>NOME</th>
						<th width='100'>CLASSE</th>
						<th width='100'>CODICE FISCALE</th>
						<th width='100'>DATA DI NASCITA</th>
						<th width='100'>ORE PCTO</th>
						<th width='100'>CORSO SICUREZZA</th>                
					<tr>";
				while($row = $result->fetch_assoc())
				{
					echo "<tr>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Matricola'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Cognome'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Nome'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Classe'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Cod_Fiscale'] . "</td>";
					$dataConvert = date_create($row['Data_Nascita']);
					$dataEurope = date_format($dataConvert ,'d/m/Y');
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $dataEurope . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['OrePCTO'] . "</td>";
					$dataConvert = date_create($row['DataEsame']);
					$dataEurope = date_format($dataConvert ,'d/m/Y');
					if($row['DataEsame']!=NULL)
					{
						$risp = 'SI';
					}
					else
					{
						$risp = 'NO';
					}

					echo "<td style='border-bottom: 1px solid #000000' align='center'>" . "<center>" . $risp . "</td>";
					echo "</tr>";
				}

				echo "</table>";
			}
			else
			{
				echo "<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Nessun valore trovato!');
					window.location='stampa_al.php';
					</SCRIPT>";
			}

			$result->free();
			$mysqli->close();
		?> 
	</div>        
	</div>
	</body>
</html>
