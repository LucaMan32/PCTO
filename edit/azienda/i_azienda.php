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

		<div align="center" class="barra"><br>&nbsp&nbsp
			<div class="aP">
				<a href="http://localhost/project/print/page.php?" title="Home"><img src="../img/home.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/print/stampa_az.php?" title="Torna indietro"><img src="../img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
				<a href="http://localhost/project/print/stampa_az.php?" title="Stampa azienda"><img src="../img/stampa.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
				&nbsp&nbsp
			<a href="http://localhost/project/index/logout.php?" title="Esci"><img src="../img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
			</div>
		</div>

		<center>
			<h1><b>AZIENDE</b></h1>
		</center>

		<div style="float: center">
			<center>
				<form method="GET" action="c_azienda.php">
					<input type="textarea" placeholder="Nome" name="Nome">
					<input type="textarea" placeholder="Città" name="Città">
					<select name="Tipo">
						<option value="">--Tipo Azienda--</option>
						<option value="Informatica">Informatica</option>
						<option value="Elettronica">Elettronica</option>
						<option value="Meccanica">Meccanica</option>
						<option value="Grafica">Grafica</option>
						<option value="Altro">Altro</option>
					</select> 
					<input type="submit" value="Cerca" name="cerca">
					<input type="reset" value="Azzera filtri" name="reset">
				</form>
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
		<?php require_once 'p_azienda.php';

			if (isset($_SESSION['message'])): 

				echo "<div ".$_SESSION['msg_type'].">";
			
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			
				echo "</div>";

			endif;

			$mysqli = new mysqli('127.0.0.1', 'root', '', 'pcto') or die(mysqli_error($mysqli));
			$result =$mysqli->query("SELECT * FROM azienda") or die($mysqli->error);
		
			echo '

				<form action="p_azienda.php" method="POST">
					<input type="text" name="NomeA" value="'. $NomeA .'" placeholder="nome azienda">	
					<input type="text" name="N_Telefono" value="'. $N_Telefono .'" placeholder="telefono">	
					<input type="text" name="Email" value="'. $Email .'" placeholder="email">	
					<input type="text" name="Indirizzo" value="'. $Indirizzo .'" placeholder="indirizzo">	
					<input type="text" name="Città" value="'. $Città .'" placeholder="città">	
					<select name="Tipo">
						<option value="">--Tipo Azienda--</option>
						<option value="Informatica">Informatica</option>
						<option value="Elettronica">Elettronica</option>
						<option value="Meccanica">Meccanica</option>
						<option value="Grafica">Grafica</option>
						<option value="Altro">Altro</option>
					</select>	
			';	
			
			if ($update == true):
			
				echo '<button type="submit" name="update">Update</button>';
			else: 
				echo '<button type="submit" name="save">Save</button>';
			endif; 
				echo "</form>";
		
				echo "
					<table width='100%'>
						<thead>
							<tr>
								<th width='100'>NOME AZIENDA</th>
								<th width='100'>TELEFONO</th>
								<th width='100'>EMAIL</th>
								<th width='100'>INDIRIZZO</th>
								<th width='100'>CITTA</th>
								<th width='100'>TIPO</th>
								<th width='100'>CHANGE</th>
								<hr>
							</tr>
						</thead>
				";
			
				while($row = $result->fetch_assoc()) 
				{
						
					echo"
						<tr style='text-align: center'>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['NomeA'] ."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['N_Telefono'] ."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['Email'] ."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['Indirizzo']."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['Città'] ."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>".$row['Tipo'] ."</td>
							<td style='border-bottom: 1px solid #000000' align='left'>
								<a href='i_azienda.php?edit=".  $row['NomeA'] ."'>edit</a>
								<a href='p_azienda.php?delete=". $row['NomeA'] ."'>delete</a>	
							</td>
						</tr>
					";
				} 
		
				echo "</table>";
			
				pre_r($result->fetch_assoc());

				function pre_r( $array ) 
				{
					echo '<pre>' ;
					print_r($array);
					echo '</pre>' ;
				}
		?> 
		</div>        
	</div>
	</body>
</html>