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
	<li><a href="iscrizione_utente.php">iscrizione utente</a></li>
	<li>iscrizione negozio</li>
	</ul>
</div>

<div id="corpo">

<?php


function form(){
$self=$_SERVER['PHP_SELF'];
echo <<<END
<h2>Iscrizione negozio al sito</h2></br>
<center><form id="form" method="post" action="$self" >
<fieldset>
<div class="spaceform">
<b>Nome</b><input type="text" placeholder="Nome" name="Nome"/></br>
<b>Nickname </b> <input type="text" placeholder="Nickname" name="Nickname" /></br>
<b>Password </b><input type="password" placeholder="Password" name="Password"/></br>
<b>Indirizzo </b><input type="text" placeholder="Indirizzo" name="Indirizzo"/></br>
<b>Telefono </b><input type="text" placeholder="Telefono" name="Telefono"/></br>
<b>E-mail </b><input type="text" placeholder="Email" name="Email"/></br></br>
<div class="spaceform"><input type="submit" name="submit" value="Iscrivi">
<input type="reset" value="Cancella"></div>
</br>
<b>Tutti i campi sono obbligatori</b></br>
</fieldset>
</form>
</div></center>
END;
}
session_start();		
require("conn.php");
if (isset($_POST['submit'])){
	$Nickname = $_POST['Nickname'];
	$query1="SELECT Nickname FROM Negozio WHERE Nickname='".$Nickname."'";
	$result1=mysql_query($query1) ;
	if(mysql_num_rows($result1)>=1){
		echo'<h3>Nickname già esistente!</h3>';
		header("Refresh:2; URL=iscrizione_negozio.php");
	}
	else{
		$Password = $_POST['Password'];
		$Nome = $_POST['Nome'];
		$Indirizzo = $_POST['Indirizzo'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];

		$query= "INSERT INTO Negozio (Nome,Nickname,Password,Indirizzo,Telefono,Email) VALUES
				('$Nome','$Nickname ',MD5('$Password'), '$Indirizzo', '$Telefono', '$Email' )";
		$result=mysql_query($query);
		//Clienti
		if($result){
			$_SESSION['login']=$_POST['Nickname'];
			$_SESSION['type'] = 'Negozio';
			echo'<h2>Iscritto con successo!';
			header("Refresh:2; URL=index.php");
		}
		else{
			echo '<p><h3>Non hai compilato i campi obbligatori o non hai inserito un campo valido!</h3></p>';
			header("Refresh:2; URL=iscrizione_negozio.php");
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