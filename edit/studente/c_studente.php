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

<div align="center" class="barra"><br><br>
	<div class="aP">
	    <a href="http://localhost/project/print/page.php" title="Home"><img src="../img/home.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
	    &nbsp&nbsp
        <a href="http://localhost/project/edit/studente/i_studente.php" title="Torna indietro"><img src="../img/arrow_back.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
	    &nbsp&nbsp
	    <a href="http://localhost/project/print/stampa_al.php" title="Stampa"><img src="../img/stampa.png" width="25px" height="25px"></a>&nbsp&nbsp&nbsp&nbsp
	    &nbsp&nbsp
		<a href="http://localhost/project/index/logout.php" title="Esci"><img src="../img/log_out.png" width="25px" height="25px"></a>&nbsp&nbsp
    </div> 
</div> 

    <center>
    	<h1><b>ALUNNI</b></h1>
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


	<?php require_once 't_studente.php'; 

	if (isset($_SESSION['message'])):

	echo "<div ".$_SESSION['msg_type'].">";

			echo $_SESSION['message'];
			unset($_SESSION['message']);
		
	echo "</div>";

 endif; 

	echo '
	<center>


	<form action="t_studente.php" method="POST">
		<input type="text" name="Matricola" value=" '.$Matricola .'" placeholder="matricola">	
		<input type="text" name="Classe" value=" '.$Classe.'" placeholder="classe">	
		<input type="text" name="Cod_Fiscale" value=" '.$Cod_Fiscale.'" placeholder="codice fisacle">	
		<input type="text" name="Nome" value=" '.$Nome.'" placeholder="nome">
		<input type="text" name="Cognome" value=" '.$Cognome.'" placeholder="cognome">	
		<input type="date" name="Data_Nascita" value=" '.$Data_Nascita.'" placeholder="gg/mm/aa">	
		<input type="text" name="OrePCTO" value=" '.$OrePCTO.'" placeholder="ore">	
		<button type="submit" name="update">Update</button>
	</form> ';

	

	$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
	$result =$mysqli->query("SELECT * FROM studente") or die($mysqli->error);

	

	

		$update = false;
	    $Nome = $_GET['Nome'];
	    $Cognome = $_GET['Cognome'];
	    $Matricola = $_GET['Matricola'];
	    $Classe = $_GET['Classe'];
	    $OrePCTO = $_GET['OrePCTO'];

	    if($Nome==NULL)
	    	if($Cognome==NULL)
	    		if($Matricola==NULL)
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					echo "";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE OrePCTO <= '$OrePCTO'";
	    				}
	    			else
	    				if ($OrePCTO==NULL) 
	    				{
	    					$sql = "SELECT * FROM studente WHERE Classe = '$Classe'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Classe = '$Classe' AND OrePCTO <= '$OrePCTO'";
	    				}
	    		else
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Matricola = '$Matricola'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Classe = '$Classe' AND Matrcola = '$Matricola' AND OrePCTO <= '$OrePCTO'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Classe = '$Classe' AND Matricola = '$Matricola'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Classe = '$Classe' AND Matricola = '$Matricola' AND OrePCTO <= '$OrePCTO'";
	    				}
	    	else
	    		if($Matricola==NULL)
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND OrePCTO <= '$OrePCTO'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Classe='$Classe'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Classe='$Classe' AND OrePCTO <= '$OrePCTO'";
	    				}
	    		else
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql= "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Matricola='$Matricola'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Matricola='$Matricola' AND OrePCTO <= '$OrePCTO'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Matricola='$Matricola' AND Classe = '$Classe' ";
                        }
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Cognome = '$Cognome' AND Matricola='$Matricola' AND Classe = '$Classe' AND OrePCTO <= '$OrePCTO' ";
	    				}
	    else
	    	if($Cognome==NULL)
	    		if($Matricola==NULL)
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome = '$Cognome'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    				    $sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Classe = '$Classe'";	
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Classe = '$Classe' AND OrePCTO='<=$OrePCTO";
	    				}
	    		else
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Matricola='$Matricola'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Matricola='$Matricola' AND OrePCTO='<=$OrePCTO'";
	    				}
	    			else
	    			    if($OrePCTO==NULL)
	    			    {
	    			    	$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Matricola='$Matricola' AND Classe = '$Classe'";
	    			    }
	    			    else
	    			    {
	    			    	$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Matricola='$Matricola' AND Classe = '$Classe' AND OrePCTO='<=$OrePCTO'";
	    			    }
	    	else
	    		if($Matricola==NULL)
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome'";
	    				}
	    				else
	    				{
	    					$mysqli = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND OrePCTO='<=$OrePCTO'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND Classe='$Classe'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND Classe='$Classe' AND OrePCTO='<=$OrePCTO'";
	    				}
	    		else
	    			if($Classe==NULL)
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND Matricola='$Matricola'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$nome' AND Cognome='$cognome' AND Matricola='$matricola' AND OrePCTO='<=$OrePCTO'";
	    				}
	    			else
	    				if($OrePCTO==NULL)
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND Matricola='$Matricola' AND Classe = '$Classe'";
	    				}
	    				else
	    				{
	    					$sql = "SELECT * FROM studente WHERE Nome = '$Nome' AND Cognome='$Cognome' AND Matricola='$Matricola' AND Classe = '$Classe' AND OrePCTO='<=$OrePCTO'";
	    				}

	    $result = $mysqli->query($sql);

	
	    echo"
	</form>

		<center>
		<br>
		<table border='0' width='100%''>
			<thead>
				<tr>
					<th width='100'>MATRICOLA</th>
					<th width='100'>COGNOME</th>
					<th width='100'>NOME</th>
					<th width='100'>CLASSE</th>
					<th width='100'>CODICE FISCALE</th>	
					<th width='100'>DATA</th>
					<th width='100'>ORE DI PCTO</th>
					<th width='100'>CORSO S.</th>
					<th width='100'>ACTION</th>
				</tr>
			</thead> ";


		while($row = $result->fetch_assoc())
			{

				echo "
				<tr style='text-align: center;'>
				<td style='border-bottom: 1px solid #000000'>". $row['Matricola'] ."</td>
				<td style='border-bottom: 1px solid #000000'>". $row['Classe'] ."</td>
				<td style='border-bottom: 1px solid #000000'>". $row['Cod_Fiscale'] ."</td>
				<td style='border-bottom: 1px solid #000000'>". $row['Nome'] ."</td>
				<td style='border-bottom: 1px solid #000000'>". $row['Cognome'] ."</td> ";
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

	    	echo "<td style='border-bottom: 1px solid #000000' align='left'>" . $risp . "</td>";
	    
	   
			echo '<td style="border-bottom: 1px solid #000000">
							<a href="i_studente.php?edit='. $row['Matricola'].'">edit</a>
							<a href="p_studente.php?delete='. $row['Matricola'].'">delete</a>	
						</td>
					</tr> ';
				
			}
		echo "</table>";

	
	    pre_r($result->fetch_assoc());

	    function pre_r( $array ) {
	    	echo '<pre>' ;
	    	print_r($array);
	    	echo '</pre>' ;
	    }

	    ?>
	
	   </center>
</body>
</html>