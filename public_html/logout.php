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
session_start();
$sname=session_name();
session_destroy();
if (isset($_COOKIE[$sname])) {
	setcookie($sname,'', time()-3600,'/');
 };
echo "<h2>Logout effettuato!</h2>";
echo '<br/>';
header("Refresh:2; URL=index.php");
?>

</div>
<div id="footer">
		 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>