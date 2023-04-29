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
        <a href="http://localhost/project/print/stampa_az.php?" title="Torna indietro"><img src="img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
	    &nbsp&nbsp
	    <a href="http://localhost/project/edit/azienda/i_azienda.php" title="Modifica alunno"><img src="img/modifica.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
	    &nbsp&nbsp
		<a href="http://localhost/project/index/logout.php?" title="Esci"><img src="img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
    </div>
</div>  
    <center>
    	<h1><b>AZIENDE</b></h1>
    </center>
    <div style="float: center">
    	<center>
    	<form method="GET" action="stampa_cerca_az.php">
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
		<?php
		$nome = $_GET['Nome'];
	    $tipo = $_GET['Tipo'];
	    $citta = $_GET['Città'];

		$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));

	    if($nome==NULL)
	    	if($tipo==NUll)
	    		if($citta==NUll)
	    		{
	    			echo "<SCRIPT LANGUAGE='JavaScript'>
		            window.alert('Devi completare almeno un campo!');
		            window.location='stampa_az.php';
		            </SCRIPT>";	    			
	    		}
	    		else
	    		{
	    			$sql = "SELECT * FROM azienda WHERE Città = '$citta'";

	    		}
	        else
	        	if($citta == NULL)
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo'";
	        		
	        	}
	        	else
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND Città = '$citta'";
	        		
	        	}
	    else
	    	if($tipo==NUll)
	    		if($citta==NUll)
	    		{
	    			$sql = "SELECT * FROM azienda WHERE azienda.NomeA = '$nome'";
	    			
	    		}
	    		else
	    		{
	    			$sql = "SELECT * FROM azienda WHERE azienda.NomeA = '$nome' AND Città = '$citta'";
	    			
	    		}
	        else
	        	if($citta==NULL)
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND azienda.NomeA = '$nome'";
	        		
	        	}
	        	else
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA ='$nome'";
	        		
	        	}
	 
	    $result = $mysqli->query($sql);

	    if($result->num_rows)
	    {
	    	echo "<center>";
	        echo "<table border ='0' width='100%'>
	            <tr>
	                <th width='100'>NOME</th>
	                <th width='100'>NUMERO DI TELEFONO</th>
	                <th width='100'>EMAIL</th>
	                <th width='100'>INDIRIZZO</th>
	                <th width='100'>CITTA'</th>
	                <th width='100'>TIPO</th>
	            <tr>";
	        while($row = $result->fetch_assoc())
	        {
	   	    echo "<tr>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['NomeA'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['N_Telefono'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Email'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Indirizzo'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Città'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $row['Tipo'] . "</td>";
	    	echo "</tr>";
	        }
	    }
	    else
	    {
	    	echo "<SCRIPT LANGUAGE='JavaScript'>
		            window.alert('Nessun valore trovato!');
		            window.location='stampa_az.php';
		            </SCRIPT>";
	    }
	 
	    $result->free();
	    $mysqli->close();    
	?> 
	</div>        
</div>
</body>
</html>
<!--
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="float: left">
		<BR>
	<a href="http://localhost/project/print/page.php?" title="Home"><img src="img/home.png" width="25px" height="25px"></a>
	<br>
	<a href="http://localhost/project/print/stampa_az.php?" title="Torna indietro"><img src="img/arrow_back.png" width="25px" height="25px"></a>
	<br>
	<a href="http://localhost/project/edit/azienda/i_azienda.php" title="Modifica stage"><img src="img/modifica.png" width="25px" height="25px"></a>
	<br>
	<a href="NOME_PAGINA_TOMMY_LOG_OUT" title="Esci"><img src="img/log_out.png" width="25px" height="25px"></a>
</div>
<div style="float: center">
	<center>
	<h1> AZIENDE </h1>
-->
	<?php
	/*
	    $nome = $_GET['Nome'];
	    $tipo = $_GET['Tipo'];
	    $citta = $_GET['Città'];

	    $conn = new mysqli("79.7.157.25","user1","user1","pcto");
	    if($conn->connect_errno)
	    {
	   	    echo "Impossibile connettersi al server: " . $conn->connect_error;
	   	    echo "<br>";
	   	    exit;
	    }

	    if($nome==NULL)
	    	if($tipo==NUll)
	    		if($citta==NUll)
	    		{
	    			echo "<SCRIPT LANGUAGE='JavaScript'>
		            window.alert('Devi completare almeno un campo!');
		            window.location='stampa_az.php';
		            </SCRIPT>";	    			
	    		}
	    		else
	    		{
	    			$sql = "SELECT * FROM azienda WHERE Città = '$citta'";

	    		}
	        else
	        	if($citta == NULL)
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo'";
	        		
	        	}
	        	else
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND Città = '$citta'";
	        		
	        	}
	    else
	    	if($tipo==NUll)
	    		if($citta==NUll)
	    		{
	    			$sql = "SELECT * FROM azienda WHERE azienda.NomeA = '$nome'";
	    			
	    		}
	    		else
	    		{
	    			$sql = "SELECT * FROM azienda WHERE azienda.NomeA = '$nome' AND Città = '$citta'";
	    			
	    		}
	        else
	        	if($citta==NULL)
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND azienda.NomeA = '$nome'";
	        		
	        	}
	        	else
	        	{
	        		$sql = "SELECT * FROM azienda WHERE Tipo = '$tipo' AND Città = '$citta' AND azienda.NomeA ='$nome'";
	        		
	        	}
	 
	    $result = $conn->query($sql);

	    if($result->num_rows)
	    {
	    	echo "<br><br><center>";
	        echo "<table border ='0' width='75%'>
	            <tr>
	                <th width='100'>NOME</th>
	                <th width='100'>NUMERO DI TELEFONO</th>
	                <th width='100'>EMAIL</th>
	                <th width='100'>INDIRIZZO</th>
	                <th width='100'>CITTA'</th>
	                <th width='100'>TIPO</th>
	            <tr>";
	        while($row = $result->fetch_assoc())
	        {
	   	    echo "<tr>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['NomeA'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['N_Telefono'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['Email'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['Indirizzo'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['Città'] . "</td>";
	    	echo "<td style='border-bottom: 1px solid #000000' align='center'>"  . "<center>" . $row['Tipo'] . "</td>";
	    	echo "</tr>";
	        }
	    }
	    else
	    {
	    	echo "<SCRIPT LANGUAGE='JavaScript'>
		            window.alert('Nessun valore trovato!');
		            window.location='stampa_az.php';
		            </SCRIPT>";
	    }
	 
	    $result->free();
	    $conn->close();
	    */
	?>
	<!--
</div>
</body>
</html>
-->