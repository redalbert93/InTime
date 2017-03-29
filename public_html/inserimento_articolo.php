<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
	<title>InTime</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="a.css" />
</head>
<body>
<div id="header">
	 <h1>InTime</h1>
	 <h2>The watch market</h2>
</div>


<div id="corpo">
<?php

function form(){
$self=$_SERVER['PHP_SELF'];
$query = "SELECT Referenza FROM Orologi";
	 $result =mysql_query($query) or die("Query fallita!" . mysql_error());
$query1 = "SELECT Codice FROM Cinturini";
	 $ris =mysql_query($query1) or die("Query fallita!" . mysql_error());	 


echo <<<END
<form id="form" method="post" action="$self" >
<fieldset>
<div class="spaceform">
<h3>Inserimento nuovo articolo</h3></br>
<b>Referenza </b>
 <select name="Referenza_O">
END;
	echo'<option value=""></option>';
	 while($row = mysql_fetch_array($result)){
	 	echo "<option value=".$row[Referenza].">".$row[Referenza]."</option>";
	}
  

echo <<<END
</select></br>
<!--<input type="text" placeholder="Referenza_O" name="Referenza_O"/></br>-->
<b>Codice cinturino </b> 
<select name="Codice_C">
END;
	 echo'<option value=""></option>';
	 while($row = mysql_fetch_array($ris)){
	 	echo "<option value=".$row[Codice].">".$row[Codice]."</option>";
	 }
  

echo <<<END
</select></br>
<!--<input type="text" placeholder="Codice_C" name="Codice_C" /></br>-->
<b>Titolo </b><input type="text" placeholder="Titolo" name="Titolo"/></br>
<b>Descrizione </b><input type="text" placeholder="Descrizione" name="Descrizione"/></br>
<b>Prezzo </b><input type="text" placeholder="Prezzo" name="Prezzo"/>€</br>
<b>Condizione (0-10) </b>
<select name="Condizione">
	<option value=""></option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
</select></br>
<!--<input type="text" placeholder="Condizione" name="Condizione"/></br>-->
<b>Quantita </b><input type="text" placeholder="Quantita" name="Quantita"/></br></br>
<div class="spaceform"><input type="submit" name="submit" value="Inserisci">
<input type="reset" value="Cancella"></div>
</br>
<b>Inserire obbligatoriamente la referenza di un orologio o/e un codice di un cinturino,titolo e descrizione</b></br>
</fieldset>
</form>
<h3>Consulta le referenze e codici disponibili nel DB <a href="./orologicintdisp.php">QUI</a></h3>
<h3>Torna <a href="./miei_articoli.php">indietro</a></h3>
</div>

END;
}
session_start();
if(!isset($_SESSION['login']))
    echo '<h2>Impossibile accedere.Prima effettuare il <a href="./login.php">Login</a>.</h2></div>';
else{
	require("conn.php");
	if($_SESSION['type']=='Persona'){
		if (isset($_POST['submit'])){
			$Referenza_O = $_POST['Referenza_O'];
			$Codice_C = $_POST['Codice_C'];
			$Titolo = $_POST['Titolo'];
			$Descrizione = $_POST['Descrizione'];
			$Prezzo = $_POST['Prezzo'];
			$Condizione = $_POST['Condizione'];
			$Quantita = $_POST['Quantita'];
		 
			if($Referenza_O != NULL AND $Codice_C == ''){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O',NULL,'$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', '".$_SESSION['login']."',NULL)";
			}
			if($Referenza_O == '' AND $Codice_C != NULL){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				(NULL,'$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', '".$_SESSION['login']."',NULL)";
			}
			if($Referenza_O == '' AND $Codice_C == ''){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O','$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', '".$_SESSION['login']."',NULL)";
			}
			if($Referenza_O != NULL AND $Codice_C != NULL){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O','$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', '".$_SESSION['login']."',NULL)";
			}
			$result=mysql_query($query);
			if($result){
				echo'<h2>Articolo inserito con successo!</h2>';
				header("Refresh:2; URL=miei_articoli.php");
			}
			else{
				echo'<h2>Articolo non inserito!</h2>'; 
				echo'<h3>controllare i campi, obbligatorio mettere un Codice cinturino o/e referenza di un orologio esatti ed esistenti nel DB,titolo e decrizione sono obbligatori, il prezzo dell orologio in vendita non può superare il prezzo di listino e se inseriamo un orologio da polso il cinturino deve rimanere nullo</h3>';
				echo'<h3>Torna  <a href="./inserimento_articolo.php">indietro</a></h2>';
			}
		}
		else{
			form();
		}
	}
	else{
		if (isset($_POST['submit'])){
			$Referenza_O = $_POST['Referenza_O'];
			$Codice_C = $_POST['Codice_C'];
			$Titolo = $_POST['Titolo'];
			$Descrizione = $_POST['Descrizione'];
			$Prezzo = $_POST['Prezzo'];
			$Condizione = $_POST['Condizione'];
			$Quantita = $_POST['Quantita']; 

			$query="SELECT Nome FROM Negozio WHERE Nickname='".$_SESSION['login']."'";
		 	$result=mysql_query($query);
		 	$raw = mysql_fetch_array($result);

			if($Referenza_O != NULL AND $Codice_C == ''){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O',NULL,'$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', NULL ,'".$raw['Nome']."')";
			}
			if($Referenza_O == '' AND $Codice_C != NULL){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				(NULL,'$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', NULL ,'".$raw['Nome']."')";
			}
			if($Referenza_O == '' AND $Codice_C == ''){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O','$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', NULL ,'".$raw['Nome']."')";
			}
			if($Referenza_O != NULL AND $Codice_C != NULL){
				$query= "INSERT INTO Articolo (Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore,NomeNegozio) VALUES    
				('$Referenza_O','$Codice_C','$Titolo', '$Descrizione', '$Prezzo', '$Condizione', '$Quantita', NULL ,'".$raw['Nome']."')";
			}

			$result=mysql_query($query);
			if($result){
				echo'<h2>Articolo inserito con successo!</h2>';
				header("Refresh:2; URL=miei_articoli.php");
			}
			else{
				echo'<h2>Articolo non inserito!</h2>'; 
				echo'<h3>controllare i campi, obbligatorio mettere un Codice cinturino  o/e una referenza di un orologio esatti ed esistenti nel DB,titolo e decrizione sono obbligatori, il prezzo dell orologio in vendita non può superare il prezzo di listino e se inseriamo un rologio da polso il cinturino deve rimanere nullo</h3>';
				echo'<h3>Torna  <a href="./inserimento_articolo.php"> indietro</a></h2>';
			}
		}
		else{
			form();
		}
	}
}
?>
</div>
<div id="footer">	 
	<h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>


</body>
</html>