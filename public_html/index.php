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
	<li>Home</li>
	<li><a href="articoli.php">Articoli</a></li>
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
	<li>Home</li>
	<li><a href="articoli.php">Articoli</a></li>
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
	 <h2>Benvenuto nel sito ufficiale di InTime</h2>
	 <p>InTime è un sito che si occupa della vendita di orologi da polso,da tasca e di cinturini di qualsiasi marca,prezzo,anno e materiale. 
		Un sistema basato su un Database aggiornabile,nel quale possono essere effettuate ricerche avanzate,possono essere inseriti articoli
		in modo da poter trovare il segna tempo più adatto ai nostri gusti e al nostro budget, oppure per inserire annunci di vendita in modo rapido e facile. 
		Un marketplace che permette ai vari utenti di avere una visione a 360° del commercio di orologi, in modo da poter trovare le migliori offerte e pezzi unici da collezzionare, riuscendo ad accontentare qualsiasi tipo di clientela, dal ricercatore di pezzi rari vintage e orologi di lusso, fino all'acquirente di un buon orologio economico.</p>
	 <p>Visita il nostro sito per scoprire i numerosi orologi messi in vendita dai nostri utenti</p>
</div>
<div id="footer">
		 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>