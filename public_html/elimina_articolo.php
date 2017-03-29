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


function form()
	{
	$self=$_SERVER['PHP_SELF'];
    echo <<<END
	
	<form id="form" method="post" action="$self" />
	<fieldset>
	<h3>Inserisci Id articolo da eliminare</h3>
	<div class="spaceform"><label>Id</label>
	<input type="text" name="Id" maxlength="5" /><br/></div>
	<div class="spaceform"><input type="submit" name="submit" value="esegui">
	<input type="reset" name="cancella" value="Cancella"></div>
	</fieldset>
	</form>
	<p><h3>Torna <a href="./miei_articoli.php">indietro</a></h3><br/>
	</div>
END;
}

session_start();
if(!isset($_SESSION['login']))
    echo '<h2>Impossibile accedere.Prima effettuare il <a href="./login.php">Login</a>.</h2></div>';
else{

	require("conn.php");
	if($_SESSION['type']=='Persona'){
		$query = "SELECT Id,Titolo,Referenza_O,Codice_C,Descrizione,Prezzo,Data,Condizione,Quantita FROM Articolo WHERE Nickname_scrittore='".$_SESSION['login']."'";
			$result =mysql_query($query) ;
			if(mysql_num_rows($result)==0){echo '<h2>Non hai pubblicato ancora nessun articolo!</h2>';}
		 	else{
		 	 echo '<h3>Miei Articoli</h3>';
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
					</tr>
				 ';
	 		}
	 		 echo '</table></div>';
		}
		if (isset($_POST['submit'])){
			$Id = $_POST['Id'];
				$query = "SELECT Titolo FROM Articolo WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
				$ris=mysql_query($query) ;
			
				if(mysql_num_rows($ris)==1){
					$q = "DELETE FROM Articolo WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
					$ris=mysql_query($q);
					echo '<h3>eliminazione articolo in corso....</h3>'; 
					header("Refresh:1; URL=elimina_articolo.php");
				}
				else{
					echo '<h3>id non esistente tra i tuoi articoli!</h3>'; 
					header("Refresh:1; URL=elimina_articolo.php");
				}
		}
		else{
			form();
		}
	}
	else{
		 $query="SELECT Nome FROM Negozio WHERE Nickname='".$_SESSION['login']."'";
		 $result=mysql_query($query) ;
		 $raw = mysql_fetch_array($result);
		 $nome = $raw['Nome'];
		 $query = "SELECT * FROM Articolo WHERE NomeNegozio='".$nome."' ";
			$result =mysql_query($query) ;
			if(mysql_num_rows($result)==0){echo '<h2>Non hai pubblicato ancora nessun articolo!</h2>';}
		 	else{
		 	 echo '<h3>Miei Articoli</h3>';
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
					</tr>
				 ';
	 		}
	 		 echo '</table></div>';
		}
		if (isset($_POST['submit'])){
			$Id = $_POST['Id'];
			$query = "SELECT Titolo FROM Articolo WHERE Id='".$Id."' AND NomeNegozio='".$nome."'";
			$ris=mysql_query($query) ;
			
			if(mysql_num_rows($ris)==1){
				$q = "DELETE FROM Articolo WHERE Id='".$Id."' AND NomeNegozio='".$nome."'";
				$ris=mysql_query($q);
				echo '<h3>eliminazione articolo in corso....</h3>'; 
				header("Refresh:1; URL=elimina_articolo.php");
			}
			else{
				echo '<h3>id non esistente tra i tuoi articoli!</h3>'; 
				header("Refresh:1; URL=elimina_articolo.php");
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