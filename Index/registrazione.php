<?php


    function verificaEmail($email){
        $email = trim($email);
        if(empty($email)){
            return false;
        }
        if(strpos($email,"@iismajorana.edu.it")==false && strpos($email,"@coordinatore.edu.it")==false){
            return false;
        }
        $cont=strlen($email)-19;
        $cont2=strlen($email)-20;

        if(strcmp(substr($email,$cont),"@iismajorana.edu.it")!= 0 && strcmp(substr($email,$cont2),"@coordinatore.edu.it")!= 0)
            return false;
        else
            return true;
    }

    function verificaPassword($password, $verificaPass){
        $trovatoMaiuscolo=0;
        $trovatoMinuscolo=0;
        $trovatoNumero=0;

        if(empty($password)){
            return false;

    
        }
        if(strlen($password)<8){
            return false;
        }
        if(strcmp($password,$verificaPass)!= 0){
            return false;
        }
        for($i=65; $i<91 ;$i++) 
            if(strpos($password,chr($i)/*,posizione da cui iniziare*/)==false)
                $trovatoMaiuscolo++;

            if($trovatoMaiuscolo==26)
                return false;

        for($i=97; $i<123 ;$i++)
            if(strpos($password,chr($i)/*,posizione da cui iniziare*/)==false)
                $trovatoMinuscolo++;
            
            if($trovatoMinuscolo==26)
                return false;
        
        for($i=48; $i<58 ;$i++)
            if(strpos($password,chr($i)/*,posizione da cui iniziare*/)==false)
                $trovatoNumero++;
                
            if($trovatoNumero==10)
                return false;

        
        if(strpos($password,".")==false && strpos($password,"/")==false && strpos($password,"-")==false && strpos($password,"*")==false && strpos($password,"@")==false){
            return false;
        }
          return true;

      }

    function verificaNuovoUtente($email){
    $mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
    $query = $mysqli->query("SELECT * FROM users WHERE IdUtente = '$email' ");
    if($query->num_rows) 
        return false;
    else
        return true;
}
    
    function WriteDB($email,$password,$nome,$cognome){
        $mysqli = new mysqli("127.0.0.1","root","","pcto") or die(mysqli_error($mysqli));
              
        $hash= password_hash($password, PASSWORD_BCRYPT);
        $toinsert = "INSERT INTO users
                            (IdUtente , password, nome, cognome, hash)
                            VALUES ('$email','$password','$nome','$cognome','$hash')";

       $result =$mysqli->query($toinsert);
       if($result)
              echo "successo";
}

if(isset($_POST["registrazione"])){

    if(verificaNuovoUtente($_POST['email'])==false)
        echo "<script type='text/javascript'>
        var richiesta = window.alert('Utente già registrato');
        window.location='login.html';
        </script>";
    elseif(verificaEmail($_POST["email"])==true && verificaPassword($_POST["password"], $_POST['verificaPass'])==true){
      
        WriteDB($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["cognome"]);

        echo "<script type='text/javascript'>
        var richiesta = window.alert('Registrazione avvenuta con successo');
        window.location='login.html';
        </script>";
    }
    else
        echo "<script type='text/javascript'>
        var richiesta = window.confirm('Dati inseriti errati o vuoti');
        if(richiesta)
            window.location='login.html';
        </script>";
        /*else
            ritorno alla home perchè l utente preme annulla*/
    
    }

 ?>
 