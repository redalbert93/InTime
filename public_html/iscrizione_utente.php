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
<div id="nav">
	<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="articoli.php">Articoli</a></li>
	<li><a href="negozi.php">Negozi</a></li>
	<li><a href="utenti.php">Utenti</a></li>
	<li><a href="login.php">Login</a></li>
	<li>iscrizione utente</li>
	<li><a href="iscrizione_negozio.php">iscrizione negozio</a></li>
	</ul>
</div>

<div id="corpo">

<?php


function form(){
$self=$_SERVER['PHP_SELF'];
echo <<<END
<h2>Iscrizione utente al sito</h2></br>
<center><form id="form" method="post" action="$self" >
<fieldset>
<div class="spaceform">
<b>Nickname </b> <input type="text" placeholder="Nickname" name="Nickname" /><b>*</b></br>
<b>Password </b><input type="password" placeholder="Password" name="Password"/><b>*</b></br>
<b>Nome</b><input type="text" placeholder="Nome" name="Nome"/><b>*</b></br>
<b>Cognome </b><input type="text" placeholder="Cognome" name="Cognome"/><b>*</b></br>
<b>Città </b><input type="text" placeholder="Città" name="Città"/></br>
<b>Telefono </b><input type="text" placeholder="Telefono" name="Telefono"/></br>
<b>E-mail </b><input type="text" placeholder="Email" name="Email"/><b>*</b></br></br>
<div class="spaceform"><input type="submit" name="submit" value="Iscrivi">
<input type="reset" value="Cancella"></div>
</br>
<b>* campi obbligatori</b></br>
</fieldset>
</form>
</div></center>
END;
}

session_start();		
require("conn.php");
if (isset($_POST['submit'])){
	$Nickname = $_POST['Nickname'];
	$query1="SELECT Nickname FROM Persona WHERE Nickname='".$Nickname."'";
	$result1=mysql_query($query1) ;
	if(mysql_num_rows($result1)>=1){
		echo'<h3>Nickname già esistente!</h3>';
		header("Refresh:2; URL=iscrizione_utente.php");
	}
	else{
		$Password = $_POST['Password'];
		$Nome = $_POST['Nome'];
		$Cognome = $_POST['Cognome'];
		$Città = $_POST['Città'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];

		$query= "INSERT INTO Persona (Nickname,Password,Nome,Cognome,Citta,Telefono,Email) VALUES
				('$Nickname ',MD5('$Password'),'$Nome', '$Cognome', '$Città', '$Telefono', '$Email' )";
				
		$result=mysql_query($query,$conn) ;
		//Clienti
		if($result){
			$_SESSION['login']=$_POST['Nickname'];
			$_SESSION['type'] = 'Persona';
			echo'<h2>Iscritto con successo!';
			header("Refresh:2; URL=index.php");
		}
		else{
			echo '<p><h3>Non hai compilato i campi obbligatori oppure uno dei campi non è valido!</h3></p>';
			header("Refresh:2; URL=iscrizione_utente.php");
		}
	}

}
else{
	form();
}
    
?>
</div>
<div id="footer">
	 	 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>