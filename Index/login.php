.<?php

session_start();

if($_POST["email"] !=NULL && $_POST["password"]!=NULL)
{
	$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
	$user = $_POST["email"]; 
	$password = $_POST["password"];

	$query = $mysqli->query("SELECT * FROM users WHERE IdUtente = '$user' AND password = '$password'");
	$sqlHash = $mysqli->query("SELECT hash FROM users WHERE IdUtente ='$user'");
	
	while($row = mysqli_fetch_object($sqlHash))
		$hash = $row->hash;
	
	if(empty($hash))
		echo  "<script type='text/javascript'>
		var richiesta = window.confirm('Account inesistente');
		if(richiesta)
			window.location='login.html';
		else
			window.location='registrazione.html';
		</script>";
	else{

		if(password_verify($password, $hash) && $query->num_rows) {
			$_SESSION["email"]=$_POST["email"];


			echo "<script type='text/javascript'>
			window.alert('Effettuato accesso con successo');
			window.location='http://localhost/project/print/page.php';
			</script>";
		} else {
			echo "<script type='text/javascript'>
			var richiesta = window.confirm('Accesso con credenziali errate');
			if(richiesta)
				window.location='login.html';
			else
				window.location='registrazione.html';
			</script>";
			}
		}	
	}
	else
		echo "<script type='text/javascript'>
	window.alert('Compilare tutti i dati');
		window.location='login.html';
		</script>";
?>

<?php/*<?php
session_start();
if(empty($_SESSION["email"])) 
           echo "<script type='text/javascript'>
		   var richiesta = window.alert('Non disponibile senza login');
		   window.location='http://localhost/project/index/login.html';
		   </script>";

if(strpos($_SESSION["email"],"@coordinatore.edu.it")==false)
echo "<script type='text/javascript'>
var richiesta = window.alert('Non dispone delle giuste autorizzazioni');
window.location='http://localhost/project/print/page';
</script>";
?>*/
?>