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
<li>Miei articoli</li>
<li><a href="negozi.php">Negozi</a></li>
	<li><a href="utenti.php">Utenti</a></li>
<li><a href="logout.php">Logout</a></li>
<li><a href="change-pwd.php">Cambia password</a></li>
<li><a href="statistiche_sito.php">statistiche_sito</a></li>
</ul>
</div>

<div id="corpo">
<?php
session_start();
if(isset($_SESSION['login'])){

if($_SESSION['type']=='Persona'){
	 require("conn.php");
	 $query = "SELECT Titolo,Referenza_O,Codice_C,Descrizione,Prezzo,Data,Condizione,Quantita FROM Articolo WHERE Nickname_scrittore='".$_SESSION['login']."'";
	 $result =mysql_query($query) ;
	 if(mysql_num_rows($result)==0){echo '<h2>Non hai pubblicato ancora nessun articolo!</h2>';}
	 else{
	 	 echo '<h2>Miei Articoli</h2>';
	 	 echo '
		 <div class="table-responsive">
			<table class="table" border="1">
			<tr>
			<th>Titolo</th>
			<th>Ref.</th>
			<th>Cod. cinturino</th>
			<th>Desc.</th>
			<th>Prezzo</th>
			<th>Data</th>
			<th>Condizione (0-10)</th>
			<th>Qtà</th>
			</tr>
		 ';
	 
		 while($row = mysql_fetch_array($result)){
			 	echo '
				<tr>
				<td>' . $row['Titolo'] . '</td>
				<td>' . $row['Referenza_O'] . '</td>
				<td>' . $row['Codice_C'] . '</td>
				<td>' . $row['Descrizione'] . '</td>
				<td>' . $row['Prezzo'] . '</td>
				<td>' . $row['Data'] . '</td>
				<td>' . $row['Condizione'] . '</td>
				<td>' . $row['Quantita'] . '</td>

				</tr>
			 ';
		 }
		 echo '</table></div>';

	}
}
else{
	 require("conn.php");
	 $query="SELECT Nome FROM Negozio WHERE Nickname='".$_SESSION['login']."'";
	 $result=mysql_query($query);
	 $raw = mysql_fetch_array($result);
	 $query = "SELECT * FROM Articolo WHERE  NomeNegozio='".$raw['Nome']."'  ";
	 $result =mysql_query($query) ;
	 if(mysql_num_rows($result)==0){echo '<h2>Non hai pubblicato ancora nessun articolo!</h2>';}
	 else{
	 	echo '<h2>Miei articoli</h2>';
	 	echo '
		 <div class="table-responsive">
			<table class="table" border="1">
			<tr>
			<th>Titolo</th>
			<th>Ref.</th>
			<th>Cod. cinturino</th>
			<th>Desc.</th>
			<th>Prezzo</th>
			<th>Data</th>
			<th>Condizione (0-10)</th>
			<th>Qtà</th>
			</tr>
		 ';
	 
		 while($row = mysql_fetch_array($result)){
			 	echo '
				<tr>
				<td>' . $row['Titolo'] . '</td>
				<td>' . $row['Referenza_O'] . '</td>
				<td>' . $row['Codice_C'] . '</td>
				<td>' . $row['Descrizione'] . '</td>
				<td>' . $row['Prezzo'] . '</td>
				<td>' . $row['Data'] . '</td>
				<td>' . $row['Condizione'] . '</td>
				<td>' . $row['Quantita'] . '</td>
				</tr>';
		 }
		 echo '</table></div>';	
	}
}
echo'<h3>Per aggiungere un nuovo articolo clicca <a href="./inserimento_articolo.php">QUI</a></h3>';
echo'<h3>Per eliminare un articolo clicca <a href="./elimina_articolo.php">QUI</a></h3>';
echo'<h3>Per modificare un articolo clicca <a href="./modifica.php">QUI</a></h3>';
}
else{
	echo '<h2>Impossibile accedere.
	Prima effettuare il <a href="./login.php">Login</a>.</h2>
	</div>
	';
}
?>
</div>
<div id="footer">
	 	 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>


</body>
</html>