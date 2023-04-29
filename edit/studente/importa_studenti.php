<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	    $mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
	    $sql = 'LOAD DATA INFILE "importa_studenti.csv" INTO TABLE studente FIELDS TERMINATED BY ";"';
	    $result = $mysqli->query($sql);
        $mysqli->close();

	    echo "<SCRIPT LANGUAGE='JavaScript'>
		          window.alert('Importazione avvenuta con successo!');
		          window.location='i_studente.php';
		          </SCRIPT>";    
	?>
</body>
</html>