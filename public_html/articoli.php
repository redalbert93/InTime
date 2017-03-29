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
<?php
session_start();
if(isset($_SESSION['login'])){
	?>
	<div id="nav">
	<ul>
	<li><a href="index.php">Home</a></li>
	<li>Articoli</li>
	<li><a href="miei_articoli.php">Miei articoli</a></li>
	<li><a href="negozi.php">Negozi</a></li>
	<li><a href="utenti.php">Utenti</a></li>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="change-pwd.php">Cambia password</a></li>
	<li><a href="statistiche_sito.php">statistiche_sito</a></li>
	</ul>
	</div>
	<?php
}else{
	?>
	<div id="nav">
	<ul>
	<li><a href="index.php">Home</a></li>
	<li>Articoli</li>
	<li><a href="negozi.php">Negozi</a></li>
	<li><a href="utenti.php">Utenti</a></li>
	<li><a href="login.php">Login</a></li>
	<li><a href="iscrizione_utente.php">iscrizione utente</a></li>
	<li><a href="iscrizione_negozio.php">iscrizione negozio</a></li>
	</ul>
	</div>
	<?php
}
?>
<div id="corpo">
	 <?php
	 if(isset($_SESSION['login'])){
	 	echo'<h3>Ricerca avanzata <a href="./ricercaarticoli.php">QUI</a></h3>';
	 }
	 echo '<h2>Articoli degli utenti in vendita</h2>';
	 require("conn.php");
	 $query = "SELECT Id,Referenza_O,Codice_C,Titolo,Data,Descrizione,Prezzo,Condizione,Quantita,Nickname_scrittore FROM Articolo WHERE NomeNegozio is NULL Order by Data DESC";
	 $result =mysql_query($query) or die("Query fallita!" . mysql_error());
	 
	 echo '
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>Id</th>
		<th>Titolo</th>
		<th>Ref.</th>
		<th>Cod. cinturino</th>
		<th>Desc.</th>
		<th>Prezzo</th>
		<th>Data</th>
		<th>Condizione (0-10)</th>
		<th>Qtà</th>
		<th>Nickname utente</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Id'] . '</td>
			<td>' . $row['Titolo'] . '</td>
			<td>' . $row['Referenza_O'] . '</td>
			<td>' . $row['Codice_C'] . '</td>
			<td>' . $row['Descrizione'] . '</td>
			<td>' . $row['Prezzo'] . '</td>
			<td>' . $row['Data'] . '</td>
			<td>' . $row['Condizione'] . '</td>
			<td>' . $row['Quantita'] . '</td>
			<td>' . $row['Nickname_scrittore'] . '</td>
			</tr>
		 ';
	 }
	 echo '</table></div>';

	 echo '<h2>Articoli dei negozi in vendita</h2>';
	 require("conn.php");
	 $query = "SELECT Id,Referenza_O,Codice_C,Titolo,Data,Descrizione,Prezzo,Condizione,Quantita,NomeNegozio FROM Articolo WHERE  Nickname_scrittore is NULL order by Data DESC";
	 $result =mysql_query($query) or die("Query fallita!" . mysql_error());
	 
	 echo '
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>Id</th>
		<th>Titolo</th>
		<th>Ref.</th>
		<th>Cod. cinturino</th>
		<th>Desc.</th>
		<th>Prezzo</th>
		<th>Data</th>
		<th>Condizione (0-10)</th>
		<th>Qtà</th>
		<th>Nome negozio</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Id'] . '</td>
			<td>' . $row['Titolo'] . '</td>
			<td>' . $row['Referenza_O'] . '</td>
			<td>' . $row['Codice_C'] . '</td>
			<td>' . $row['Descrizione'] . '</td>
			<td>' . $row['Prezzo'] . '</td>
			<td>' . $row['Data'] . '</td>
			<td>' . $row['Condizione'] . '</td>
			<td>' . $row['Quantita'] . '</td>
			<td>' . $row['NomeNegozio'] . '</td>
			</tr>
		 ';
	 }
	 echo '</table></div>';
	 ?>

</div>
<div id="footer">
	 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>

</body>
</html>