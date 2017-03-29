<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
	<title>Area di Amministrazione</title>
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

session_start();

if(!isset($_SESSION['login']))
	echo '<h2>Impossibile accedere.
	Prima effettuare il <a href="./login.php">Login</a>.</h2>
	</div>
	';
else{
	function form()
	{
	$self=$_SERVER['PHP_SELF'];
    echo <<<END
	<h2>Cambio Password</h2>
	<center><form id="form" method="post" action="$self" />
	<fieldset>
	<div class="spaceform"><label>Vecchia Password</label>
	<input type="password" name="old" maxlength="20" /><br/></div>
	<div class="spaceform"><label>Nuova Password</label>
	<input type="password" name="new" maxlength="20"/><br/></div>
	<div class="spaceform"><label>Conferma Nuova Password</label>
	<input type="password" name="new1" maxlength="20"/><br/></div>
	<div class="spaceform"><input type="submit" name="submit" value="Avanti">
	<input type="reset" name="cancella" value="Cancella"></div>
	</fieldset>
	</form></center>
	<p><h3>Torna nell'
	<a href="./index.php">Homepage</a></h3><br/>
	</div>
END;
}
	require("conn.php");
	if (isset($_POST['submit']))
	{	
		$old=$_POST['old'];
		$new=$_POST['new'];
		$new1=$_POST['new1'];

		if($old == '' || $new=='' || $new1==''){
			echo '<h3>Compila tutti i campi!</h3>';
			header("Refresh:2; URL=change-pwd.php");
		}
		elseif($new!=$new1){
			echo '<h3>Le Password non corrispondono</h3>';
			header("Refresh:2; URL=change-pwd.php");
		}else{

			$query=" SELECT Password FROM ".$_SESSION['type']." WHERE Nickname='".$_SESSION['login']."' AND Password='".MD5($old)."'  ";
			$loginpwd=mysql_query($query);
			
			if(mysql_num_rows($loginpwd)==1){
					//Trovato
					$query="UPDATE ".$_SESSION['type']." SET Password='".MD5($new)."' WHERE Nickname='".$_SESSION['login']."'";
					$psw=mysql_query($query,$conn);

					if($psw){
						echo'<h2>Password Cambiata con successo</h2>';
						header("Refresh:2; URL=index.php");
					}
					else{
						echo '<h3>La password nuova è uguale alla vecchia!</h3>';
						header("Refresh:2; URL=change-pwd.php");
					}
			}
			else{
				echo '<h3>La Vecchia Password è sbagliata!</h3>';
				header("Refresh:2; URL=change-pwd.php");
			}
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