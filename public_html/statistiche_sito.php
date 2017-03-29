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
	<li><a href="utenti.php">Utenti</a></li>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="change-pwd.php">Cambia password</a></li>
	<li>Statistiche_sito</li>
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
	 echo '<b>Negozio che ha maggiori orologi in vendita</b>';
	 require("conn.php");
	 $query = "SELECT Nome, MAX(Sommaquantita) AS TotaleMassimo FROM narticoli";
	 $result =mysql_query($query) ;
	 
	 echo '
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>Negozio</th>
		<th>Orologi in vendita</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Nome'] . '</td>
			<td>' . $row['TotaleMassimo'] . '</td>
			</tr>
		 ';
	 }
	 echo '</table></div></br></br>';


	 $query = "SELECT Id,avg(Condizione-1)
				FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
				WHERE o.Marca IN (SELECT NomeMarche 
							 FROM Vende)";
	 $result =mysql_query($query) ;
	 
	 echo '
	 <b>Media delle condizioni e il numero degli articoli totali con marche vendute dai negozi associati</b>
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>n°articoli</th>
		<th>Media condizione</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row[0] . '</td>
			<td>' . $row[1] . '</td>
			</tr>
		 ';
	 }
	 echo '</table></div></br></br>';

	  $query = "SELECT a.Id,a.Prezzo,a.Condizione,a.Referenza_O,o.Marca,o.Modello,o.Calibro,a.Titolo,a.Descrizione,a.Nickname_Scrittore,a.NomeNegozio
FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
WHERE o.Marca IN (SELECT Nome FROM Marche) AND  a.Prezzo=(SELECT MAX(Prezzo) FROM Articolo) ";
	 $result =mysql_query($query);
	 
	if(mysql_num_rows($result)>=1){
		 echo '<b>Orologio più caro con marca riconosciuta dal sito</b>';
	 	 echo '
		 <div class="table-responsive">
			<table class="table" border="1">
			<tr>
			<th>Id articolo</th>
			<th>Prezzo</th>
			<th>Condizione</th>
			<th>Referenza</th>
			<th>Marca</th>
			<th>Modello</th>
			<th>Calibro</th>
			<th>Titolo</th>
			<th>Descrizione</th>
			<th>Nickname</th>
			<th>Negozio</th>
			</tr>
		 ';

		while($row = mysql_fetch_array($result)){
			echo '<tr>	
				  <td>' . $row[0] . '</td> 	
				  <td>' . $row[1] . '</td>
				   <td>' . $row[2] . '</td>
				  <td>' . $row[3] . '</td> 
				  <td>' . $row[4] . '</td>
				  <td>' . $row[5] . '</td>
				  <td>' . $row[6] . '</td>  
				  <td>' . $row[7] . '</td>   
				  <td>' . $row[8] . '</td>
				   <td>' . $row[9] . '</td>
				    <td>' . $row[10] . '</td>   
				  </tr>  ';
		}
		echo '</table></div></br></br>';
	}
	

$query = "SELECT ultimiorologi() ";
$result =mysql_query($query);
echo '<b>Numero articoli messi in vendita quest ultimo mese</b>';
	 	 echo '
		 <div class="table-responsive">
			<table class="table" border="1">
			<tr>
			<th>N° articoli</th>
			</tr>
		 ';

		while($row = mysql_fetch_array($result)){
			echo '<tr>	
				  <td>' . $row[0] . '</td> 	
				  </tr>  ';
		}
		echo '</table></div></br></br>';
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