<?php
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
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../../style.css" rel="stylesheet" type="text/css">
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

		<div align ="center" class="barra"><br>&nbsp&nbsp
			<div class="aP">
				<a href="http://localhost/project/print/page.php?" title="Home"><img src="../img/home.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/print/stampa_corso.php?" title="Torna indietro"><img src="../img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/print/stampa_corso.php" title="Stampa"><img src="../img/stampa.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
			<a href="NOME_PAGINA_TOMMY_LOG_OUT" title="Esci"><img src="../img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
			</div> 
		</div>

		<center>
			<h1><b>CORSO SICUREZZA</b></h1>
		</center>

		<div style="float: center">
			<center>
			<form method="POST" action="c_corso.php">
				<input type="textarea" placeholder="Codice" name="Codice">
				<input type="textarea" placeholder="OreMax" name="OreMax">
				<input type="textarea" placeholder="Matricola" name="Matricola">
				<input type="textarea" placeholder="Azienda" name="Azienda">
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


		<?php require_once 'p_corso.php'; 

			if (isset($_SESSION['message'])): 

				echo "<div ".$_SESSION['msg_type'].">";
				
				echo $_SESSION['message'];
				unset($_SESSION['message']);
					
				echo "</div>";
			endif;

			$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
			$result =$mysqli->query("SELECT * FROM corso") or die($mysqli->error);

			echo '
				<form action="p_corso.php" method="POST">
					<input type="text" name="Cod_Corso" value=" '. $Cod_Corso .'" placeholder="codice corso">	
					<input type="text" name="OreC" value=" '. $OreC.'" placeholder="numero di ore">	
					<input type="date" name="DataEsame" value=" '. $DataEsame .'" placeholder="data esame">	
					<input type="text" name="NomeA" value=" '. $NomeA .'" placeholder="nome azienda">	
					<input type="text" name="Matricola" value=" '. $Matricola .'" placeholder="matricola">
			';	
		 
			if ($update == true):
				echo '<button type="submit" name="update">Update</button> ';
		 	else: 
				echo '<button type="submit" name="save">Save</button>';
	 		endif; 
				echo '</form>';

			echo'
				<center>
				<table border ="0" width="100%">
					<thead>
						<tr>
							<th width="100">CODICE CORSO</th>
							<th width="100">NUMERO ORE</th>
							<th width="100">DATA ESAME</th>					
							<th width="100">NOME AZIENDA</th>
							<th width="100">MATRICOLA</th>
							<hr>
							<th width="100">ACTION</th>
						</tr>
					</thead> 
			';
			
			while($row = $result->fetch_assoc()): 
				echo "<tr>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Cod_Corso'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['OreC'] . "</td>";
					$dataConvert = date_create($row['DataEsame']);
					$dataEurope = date_format($dataConvert ,'d/m/Y');
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $dataEurope . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['NomeA'] . "</td>";
					echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Matricola'] . "</td>";
					
					echo '<td style="border-bottom: 1px solid #000000">
					<a href="i_corso.php?edit='. $row['Cod_Corso'] .' ">edit</a>
					<a href="p_corso.php?delete='. $row['Cod_Corso'] .'">delete</a>	
						</td>
					</tr> 
				';
			endwhile; 
	 
			pre_r($result->fetch_assoc());

			function pre_r( $array ) 
			{
				echo '<pre>' ;
				print_r($array);
				echo '</pre>' ;
			}
		?>
	
	</center>
	</body>
</html>