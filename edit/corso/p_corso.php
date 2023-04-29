<?php
	

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

	$mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
	    
	$update = false; 
	$Cod_Corso = '';
	$OreC = '';
	$DataEsame = '';   
	$NomeA = '';
	$Matricola = '';
	$a=0;

	if(isset($_POST['save']))
    {
    	$Cod_Corso = $_POST['Cod_Corso'];
    	$OreC = $_POST['OreC'];
    	$DataEsame = $_POST['DataEsame'];
    	$NomeA = $_POST['NomeA'];
    	$Matricola = $_POST['Matricola'];

    	$dataoggi = date("d/m/Y"); //acquisizione data odierna
    	$sec1 = strtotime($DataEsame);  //trasformazione data esame in secondi
    	$sec2 = strtotime($dataoggi);  //trasformazione data odeirna in secondi

    	if($sec1 > $sec2)  //controllo se data inserita è prima della data di oggi
    	{
    		$_SESSION['message'] = "INSERIRE UNA DATA VALIDA";
   			$_SESSION['msg_type'] = "success";
   			$a=1;
    	}

    	if($OreC>20 || $OreC<0) //controllo ore 
    	{
	    	$_SESSION['message'] = "LE ORE DEVONO ESSERE COMPRESE TRA 0 E 20";
	   		$_SESSION['msg_type'] = "success";
	  		$a=1;
	   	}

	   	$result = $mysqli->query("SELECT * FROM studente WHERE studente.Matricola='$Matricola'") or //se esiste matricola
	    	die($mysqli->error);

	      $result2 = $mysqli->query("SELECT * FROM azienda WHERE azienda.NomeA='$NomeA'") or //se esiste azienda
	    	die($mysqli->error);

	   	$result3 = $mysqli->query("SELECT * FROM corso WHERE corso.Matricola='$Matricola'") or //matricola già esistente
	    	die($mysqli->error);

	        if($result3->num_rows)//matricola già esistente
	        {
	    	 	$_SESSION['message'] = "matricola già esistente";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }

            //matricola
	    	if($result->num_rows)
	        {
	    	 	
	        }
	        else
	        {
	    	 	$_SESSION['message'] = "inserimento matricola errato";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }
	    	
	    	//azienda
	    	if($result2->num_rows)
	        {
	    	 	
	        }
	        else
	        {
	    	 	$_SESSION['message'] = "inserimento azienda sbagiato";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }

	    	if($OreC!==20 && $a!=1)  //salvataggio effettivo
	    	{   
	    		$mysqli->query("INSERT INTO corso (Cod_Corso, OreC, DataEsame, NomeA, Matricola) VALUES ('$Cod_Corso', '$OreC', '$DataEsame', '$NomeA', '$Matricola')") or 
	    		die($mysqli->error);

	    		$_SESSION['message'] = "Corso salvato";
	   			$_SESSION['msg_type'] = "success";
	   		}
	   		
	   		header("location: i_corso.php");
	    }

	    if (isset($_GET['delete']))
	    {
	    	$Cod_Corso = $_GET['delete'];
	    	$mysqli->query("DELETE FROM corso WHERE Cod_Corso=$Cod_Corso") or die($mysqli->error());

	    	$_SESSION['message'] = "Corso eliminato";
	    	$_SESSION['msg_type'] = "danger";

	    	header("location: i_corso.php");
	    }

	    if (isset($_GET['edit']))
	    {
	    	$Cod_Corso = $_GET['edit'];
	    	$update = true;
			$result = $mysqli->query("SELECT * FROM corso WHERE Cod_Corso=$Cod_Corso") or die ($mysqli->error());
	    	if(is_countable($result)==1)
	    	{
	    		$row = $result->fetch_array();
	    		$Cod_Corso = $row['Cod_Corso'];
	    		$OreC = $row['OreC'];
		    	$DataEsame= $row['DataEsame'];
	    		$NomeA = $row['NomeA'];
	    		$Matricola = $row['Matricola'];
	    	}
	    }

	    if (isset($_POST['update']))
	    {
	    	$Cod_Corso = $_POST['Cod_Corso'];
	    	$OreC = $_POST['OreC'];
	    	$DataEsame = $_POST['DataEsame'];
	    	$NomeA = $_POST['NomeA'];
	    	$Matricola = $_POST['Matricola'];

	    	$dataoggi = date("d/m/Y"); //acquisizione data odierna
    		$sec1 = strtotime($DataEsame);  //trasformazione data esame in secondi
    		$sec2 = strtotime($dataoggi);  //trasformazione data odeirna in secondi

    		if($sec1 > $sec2)  //controllo data
    		{
    			$_SESSION['message'] = "INSERIRE UNA DATA VALIDA";
   				$_SESSION['msg_type'] = "success";
   				$a=1;
    		}

    		if($OreC>20 || $OreC<0) //controllo ore
    		{
	   		 	$_SESSION['message'] = "LE ORE DEVONO ESSERE COMPRESE TRA 0 E 20";
	   			$_SESSION['msg_type'] = "success";
	  			$a=1;
	   		}

	   		$result = $mysqli->query("SELECT * FROM studente WHERE studente.Matricola='$Matricola'") or //se esiste matricola
	    		die($mysqli->error);

		      $result2 = $mysqli->query("SELECT * FROM azienda WHERE azienda.NomeA='$NomeA'") or //se esiste azienda
	    		die($mysqli->error);

		   	$result3 = $mysqli->query("SELECT * FROM corso WHERE corso.Matricola='$Matricola'") or //matricola già esistente
	    		die($mysqli->error);

	        if($result3->num_rows)//matricola già esistente
	        {
	    	 	$_SESSION['message'] = "matricola già esistente";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }

            //matricola
	    	if($result->num_rows)
	        {
	    	 	
	        }
	        else
	        {
	    	 	$_SESSION['message'] = "inserimento matricola errato";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }
	    	
	    	//azienda
	    	if($result2->num_rows)
	        {
	    	 	
	        }
	        else
	        {
	    	 	$_SESSION['message'] = "inserimento azienda sbagiato";
	   			$_SESSION['msg_type'] = "success";
	   			$a=1;
	        }

	    	if($OreC!==20 && $a!=1)  //salvataggio effettivo
	    	{   
	    		$mysqli->query("UPDATE corso SET Cod_Corso='$Cod_Corso', OreC='$OreC', DataEsame='$DataEsame', NomeA='$NomeA', Matricola='$Matricola' WHERE Cod_Corso=$Cod_Corso") or die($mysqli->error);

	    		$_SESSION['message'] = "Corso salvato";
	   			$_SESSION['msg_type'] = "success";
	   		}

	    	header("location: i_corso.php");
	    }
?>