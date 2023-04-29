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
		<title></title>
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class ="barra1">
			<form align ="center" action="../index/logout.php">
				<br>
				<input class ="botPage" type="submit" value="logOut">
			</form>
		</div>
		<center>
			<br>
			<br>
			<br>
		<table border="0" width="100%">
			<tr>
				<td align="right"><a href="stampa_al.php" title="Studenti"><img src="img/studenti.jpg" width="310px" height="210px" style="border: 1px; border-style: solid; border-radius: 30px" onmouseover="this.src='img/studenti2.jpg'"
				onmouseout="this.src='img/studenti.jpg'"></a>&nbsp&nbsp&nbsp</td>
				<td>&nbsp&nbsp&nbsp<a href="stampa_az.php" title="Aziende"><img src="img/azienda.jpg" width="310px" height="210px" style="border: 1px; border-style: solid; border-radius: 30px" onmouseover="this.src='img/azienda2.jpg'"
				onmouseout="this.src='img/azienda.jpg'"></a></td>
			</tr>
			<tr>
				<td align="right"><a href="stampa_corso.php" title="Corso sicurezza"><img src="img/sicurezza.jpg" width="310px" height="210px" style="border: 1px; border-style: solid; border-radius: 30px"
				onmouseover="this.src='img/sicurezza2.jpg'"
				onmouseout="this.src='img/sicurezza.jpg'"></a>&nbsp&nbsp&nbsp</td>
				<td>&nbsp&nbsp&nbsp<a href="stampa_stage.php" title="Stage"><img src="img/stage.jpg" width="310px" height="210px" style="border: 1px; border-style: solid; border-radius: 30px" 
				onmouseover="this.src='img/stage2.jpg'"
				onmouseout="this.src='img/stage.jpg'"></a></td>
			</tr>
		</table>
	</body>
</html>