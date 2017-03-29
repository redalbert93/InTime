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
	<li><a href="articoli.php">Articoli</a></li>
	<li><a href="miei_articoli.php">Miei articoli</a></li>
	<li><a href="negozi.php">Negozi</a></li>
	<li>Utenti</li>
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
	<li><a href="articoli.php">Articoli</a></li>
	<li><a href="negozi.php">Negozi</a></li>
	<li>Utenti</li>
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
	 echo '<h2>Utenti</h2>';
	 require("conn.php");
	 $query = "SELECT Nickname,Nome,Cognome,Citta,Telefono,Email,Data_Iscrizione FROM Persona Order by Nickname";
	 $result =mysql_query($query) or die("Query fallita!" . mysql_error());

	 echo '
		<div class="table-responsive">
		<table class="table" border="1">
		<tr>
		
		<th>Nickname</th>
		<th>Nome</th>
		<th>Cognome</th>
		<th>Città</th>
		<th>Telefono</th>
		<th>E-mail</th>
		<th>Data iscrizione</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Nickname'] . '</td>
			<td>' . $row['Nome'] . '</td>
			<td>' . $row['Cognome'] . '</td>
			<td>' . $row['Citta'] . '</td>
			<td>' . $row['Telefono'] . '</td>
			<td>' . $row['Email'] . '</td>
			<td>' . $row['Data_Iscrizione'] . '</td>
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