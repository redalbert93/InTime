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
	<li>Login</li>
	<li><a href="iscrizione_utente.php">iscrizione utente</a></li>
	<li><a href="iscrizione_negozio.php">iscrizione negozio</a></li>
	</ul>
</div>

<div id="corpo">

<?php
session_start();
if(isset($_SESSION['login'])){
	echo '<h2>Hai già effettuato il login!</h2>
	<p>Accedi ad InTimes cliccando
	<a href="./index.php">qui.</a></p>
	<p><a href="./change-pwd.php">Cambia Password</a></p>
	</div>';
}
else{

function form(){
$self=$_SERVER['PHP_SELF'];
echo <<<END
<h2>Login</h2>
<center><form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>Username </b><input type="text" placeholder="Username" name="login"/></br>
<b>Password </b><input type="password" placeholder="Password" name="pwd"/></div>
<input type="radio" name="type" value="Persona" checked>Utente
<input type="radio" name="type" value="Negozio">Negozio</br>
<div class="spaceform"><input type="submit" name="submit" value="Login">
<input type="reset" value="Cancella"></div>
</fieldset>
</form></center>


END;
}
		require("conn.php");
		if (isset($_POST['submit'])){
				if(($_POST['login']) && ($_POST['pwd'])){
					$cf= $_POST['login'];
					$pw= $_POST['pwd'];
					$password = md5($pw);
					$type = $_POST['type'];
					
	
					$query= "SELECT Nickname, Password FROM ".$type." WHERE Nickname = '".$cf."' AND Password = '".$password."'  ";
					$result=mysql_query($query);
					//Clienti
					if(mysql_num_rows($result)==1){
						//Trovato
						//Inizia sessione (cliente)
						$_SESSION['type']=$type;    
						$_SESSION['login']=$cf;
						echo "<p><h3>Verifica dati in corso...<h3></p>";
						header("Refresh:2; URL=index.php");
						
					}
					else{
						echo "<p><h3>Username e/o password errati</h3></p>";
						header("Refresh:2; URL=login.php");
					}
				}
				else{
					echo '<p><h3>Non hai compilato entrambi i campi!</h3></p>';
					header("Refresh:2; URL=login.php");
				}
		}
		else{
			form();
		}
    }
?>
</div>
<div id="footer">	 
	<h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>