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
echo '<h3>OROLOGI DISPONIBILI NEL DB</h3>';
require("conn.php");
	 $query = "SELECT * FROM Orologi ORDER BY Marca";
	 $result =mysql_query($query) ;
	 
	 echo '
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>Ref.</th>
		<th>Prezzo Listino</th>
		<th>Marca</th>
		<th>Modello</th>
		<th>Calibro</th>
		<th>Carica</th>
		<th>Materiale</th>
		<th>Anno</th>
		<th>Sesso</th>
		<th>Diametro</th>
		<th>Tipo</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Referenza'] . '</td>
			<td>' . $row['Prezzo_nuovo'] . '</td>
			<td>' . $row['Marca'] . '</td>
			<td>' . $row['Modello'] . '</td>
			<td>' . $row['Calibro'] . '</td>
			<td>' . $row['Carica'] . '</td>
			<td>' . $row['Materiale'] . '</td>
			<td>' . $row['Anno'] . '</td>
			<td>' . $row['Sesso'] . '</td>
			<td>' . $row['Diametro'] . '</td>
			<td>' . $row['Tipo'] . '</td>
			</tr>
		 ';
	 }
	 echo '</table></div></br></br>';
	 echo'<h3>CINTURINI DISPONIBILI NEL DB</h3>';
	 	 $query = "SELECT * FROM Cinturini ";
	 $result =mysql_query($query);
	 
	 echo '
	 <div class="table-responsive">
		<table class="table" border="1">
		<tr>
		<th>Codice</th>
		<th>Colore</th>
		<th>Materiale</th>
		</tr>
	 ';
	 
	 while($row = mysql_fetch_array($result)){
		 	echo '
			<tr>
			<td>' . $row['Codice'] . '</td>
			<td>' . $row['Colore'] . '</td>
			<td>' . $row['Materiale'] . '</td>
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