<?php
$host="localhost";
$user="arossett"; //arossett
$pwd= "0eJGrPFn";   //0eJGrPFn psw per il lab
$conn=mysql_connect($host, $user, $pwd)
		or die($_SERVER['PHP_SELF'] . "Connessione fallita!");
$dbname="arossett-PR";
mysql_select_db($dbname);
?>

