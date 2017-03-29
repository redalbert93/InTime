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


function form(){
$self=$_SERVER['PHP_SELF']."#0";
$query = "SELECT * FROM Marche";
$result =mysql_query($query) ;
echo <<<END
<form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>[RICERCA TRA I NEGOZI]:Ricerca le caratteristiche di tutti gli orologi di una certa marca,prezzo e anno, trovando l'Id dell'articolo,il nome del negozio e l'e-mail di chi li ha pubblicati ordinati per data di inserzione dell'articolo</b></br></br>
<b>Marca..</b>
<select name="Marca">
END;
	 while($row = mysql_fetch_array($result)){
	 	echo "<option value=".$row[0].">".$row[0]."</option>";
	}
echo <<<END
</select></br>
<!--<input type="text" placeholder="Marca" name="Marca"/></br>-->
<b>Prezzo fino a..</b><input type="text" placeholder="Prezzo" name="Prezzo"/><b>€</b></br>
<b>Anno da..</b><input type="text" placeholder="Anno" name="Anno" /></br>
<div class="spaceform"><input type="submit" name="submit" value="Ricerca">
<input type="reset" value="Cancella"></br></br>
<b>Tutti i campi sono obbligatori</b></div>
</br>
</fieldset>
</form>
END;
}


function form1(){
$self=$_SERVER['PHP_SELF']."#1";
$query = "SELECT * FROM Marche";
$result =mysql_query($query);
echo <<<END
<form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>Ricerca di tutti gli articoli che hanno uno sconto superiore alla % immessa ordinati per prezzo con una marca riconosciuta e venduta da uno dei negozi associati</b></br></br>
<b>Inserire percentuale</b>
<select name="Percentuale">
				<option value="0">0%</option>
				<option value="10">10%</option>
				<option value="20">20%</option>
				<option value="30">30%</option>
				<option value="40">40%</option>
				<option value="50">50%</option>
				<option value="60">60%</option>
				<option value="70">70%</option>
				<option value="80">80%</option>
				<option value="90">90%</option>
</select></br>
<!--<input type="text" placeholder="Percentuale" name="Percentuale" /><b>%</b></br>-->
<div class="spaceform"><input type="submit" name="submit1" value="Ricerca">
<input type="reset" value="Cancella"></br></br>
</br>
</fieldset>
</form>
END;
}

function form2(){
$self=$_SERVER['PHP_SELF']."#2";
$query1 = "SELECT Nickname FROM Negozio";
$result1 =mysql_query($query1) ;
echo <<<END
<form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>Trovare articoli di marca Zenith con cinturino in acciaio del negozio con Nickname inserito</b></br></br>
<b>Nickname negozio...</b>
<select name="Nickname">
END;
	 while($row = mysql_fetch_array($result1)){
	 	echo "<option value=".$row[0].">".$row[0]."</option>";
	}
echo <<<END
</select></br>
<!--<input type="text" placeholder="Nickname" name="Nickname"/></br>-->
<div class="spaceform"><input type="submit" name="submit2" value="Ricerca">
<input type="reset" value="Cancella"></br></br>
</div>
</br>
</fieldset>
</form>
END;
}

function form3(){
$self=$_SERVER['PHP_SELF']."#3";

echo <<<END
<form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>Visualizza gli articoli caricati dal .. al .. che hanno una condizione maggiore di quella inserita, di sesso M D X, di marca con iniziale inserita ,ordinati per data di inserzione</b></br></br>
<b>dal..</b><input type="text" placeholder="Anno" name="Data1" /></br>
<b>al..</b><input type="text" placeholder="Anno" name="Data2" /></br>
<b>Sesso: </b>
<select name="Sesso">
				<option value="M">M</option>
				<option value="D">D</option>
				<option value="X">X</option>
</select></br>
<!--<input type="text" placeholder="Sesso" name="Sesso"/></br>-->
<b>Iniziale Marca</b><input type="text" placeholder="Marca" name="Marca" /></br>
<b>Condizione superiore a.. </b>
<select name="Condizione">
	<option value=""></option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
</select></br>
<!--<input type="text" placeholder="Condizione" name="Condizione"/></br>-->
<div class="spaceform"><input type="submit" name="submit3" value="Ricerca">
<input type="reset" value="Cancella"></br></br>
</div>
</br>
</fieldset>
</form>
END;
}


function form4(){
$self=$_SERVER['PHP_SELF']."#4";
$query1 = "SELECT Nickname FROM Persona";
$result1 =mysql_query($query1);
echo <<<END
<form id="form" method="post" action="$self">
<fieldset>
<div class="spaceform">
<b>Trovare la data dell'ultimo articolo caricato dall'utente con</b></br></br>
<b>Nickname : </b>
<select name="Nickname">
END;
	 while($row = mysql_fetch_array($result1)){
	 	echo "<option value=".$row[0].">".$row[0]."</option>";
	}
echo <<<END
</select></br>
<!--<input type="text" placeholder="Nickname" name="Nickname"/></br>-->
<div class="spaceform"><input type="submit" name="submit4" value="Ricerca">
<input type="reset" value="Cancella"></br></br>
</div>
</br>
</fieldset>
</form>
END;
}

session_start();
if(!isset($_SESSION['login']))
    echo '<h2>Impossibile accedere.Prima effettuare il <a href="./login.php">Login</a>.</h2></div>';
else{
	require("conn.php");
	if(isset($_SESSION['login'])){
	echo'<h2>RICERCHE AVANZATE</h2></br>';

	if (isset($_POST['submit'])){
	            if($_POST['Marca'] != NULL AND $_POST['Prezzo'] != NULL AND $_POST['Anno'] != NULL){
	                $query= "SELECT o.Marca,o.Modello,o.Calibro,o.Carica,o.Referenza,o.Anno,a.Id,a.Titolo,a.Descrizione,a.NomeNegozio,n.Email
							 FROM (Articolo a JOIN Negozio n ON a.NomeNegozio=n.Nome) JOIN Orologi o ON a.Referenza_O=o.Referenza
							 WHERE a.Prezzo<".$_POST['Prezzo']." AND o.Marca='".$_POST['Marca']."' AND o.Anno>".$_POST['Anno']."
							 ORDER BY a.Data DESC";
	            
					$ris=mysql_query($query);
	 				if($ris){
		           		if(mysql_num_rows($ris)>=1){
		                		 echo '<h3>Risultato</h3>';
							 	 echo '
								 <div class="table-responsive" id="0">
									<table class="table" border="1">
									<tr>
									<th>Marca</th>
									<th>Modello</th>
									<th>Calibro</th>
									<th>Carica</th>
									<th>Referenza</th>
									<th>Anno Orologios</th>
									<th>Id</th>
									<th>Titolo</th>
									<th>Descrizione</th>
									<th>Negozio</th>
									<th>E-mail</th>
									</tr>
								 ';
							 
								 while($row = mysql_fetch_array($ris)){
									 	echo '
										<tr>
										<td>' . $row['Marca'] . '</td>
										<td>' . $row['Modello'] . '</td>
										<td>' . $row['Calibro'] . '</td>
										<td>' . $row['Carica'] . '</td>
										<td>' . $row['Referenza'] . '</td>
										<td>' . $row['Anno'] . '</td>
										<td>' . $row['Id'] . '</td>
										<td>' . $row['Titolo'] . '</td>
										<td>' . $row['Descrizione'] . '</td>
										<td>' . $row['NomeNegozio'] . '</td>
										<td>' . $row['Email'] . '</td>
										</tr>
									 ';
								 }
								 echo '</table></div>';
		        		
						echo'<h3>Effettua una nuova <a href="./ricercaarticoli.php">RICERCA</a></h3>';		
		            	}
		            	else{
			                echo "<h3>Non è stato trovato nessun articolo con queste caratteristiche!</h3>";
			                header("Refresh:2; URL=ricercaarticoli.php");
			            }
					}
					else{
		           		echo "<h3>I campi sono sbagliati!</h3>";
		           	}
	        	}
	        	else{
	        		echo "<h3>Non sono stati compilati tutti i campi!</h3>";
	        		 header("Refresh:2; URL=ricercaarticoli.php");
	        	}
	}
	else{
		form();
	}
	echo '</br></br>';
	if (isset($_POST['submit1'])){
		if ($_POST['Percentuale']!=''){
		$query1="SELECT a.Id,a.Prezzo,o.Prezzo_nuovo,a.Referenza_O,o.Marca,a.Titolo,a.Descrizione,a.Nickname_Scrittore,a.NomeNegozio
				FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
				WHERE (o.Prezzo_nuovo-a.Prezzo)>=((o.Prezzo_nuovo*".$_POST['Percentuale'].")/100) AND o.Marca IN (SELECT Nome FROM Marche)
				ORDER BY a.Prezzo DESC"; 
		$result=mysql_query($query1);
		if(mysql_num_rows($result)>=1){
			 echo '<h3>Risultato</h3>';
		 	 echo '
			 <div class="table-responsive" id="1">
				<table class="table" border="1">
				<tr>
				<th>Id articolo</th>
				<th>Prezzo</th>
				<th>Referenza</th>
				<th>Marca</th>
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
					  <td>' . $row[3] . '</td> 
					  <td>' . $row[4] . '</td>
					  <td>' . $row[5] . '</td>
					  <td>' . $row[6] . '</td>  
					  <td>' . $row[7] . '</td>   
					  <td>' . $row[8] . '</td>   
					  </tr>  ';
			}
			echo '</table></div>';
			echo'<h3>Effettua una nuova <a href="./ricercaarticoli.php">RICERCA</a></h3>';	
		}
		else{
			echo "<h3>Non è stato trovato nessun articolo con queste caratteristiche!</h3>";
	        header("Refresh:2; URL=ricercaarticoli.php");
		}
		}
		else{
			echo "<h3>Inserire una percentuale!</h3>";
	        header("Refresh:2; URL=ricercaarticoli.php");
		}
	}
	else{form1();}
	echo '</br></br>';
	if (isset($_POST['submit2'])){

		$query="SELECT Id, Referenza, Modello,Prezzo, Codice_C, Email
				FROM articolinegozi
				WHERE NomeNegozio=(
				SELECT Nome
				FROM Negozio
				WHERE Nickname='$_POST[Nickname]'
				)"; 
		$result=mysql_query($query);
		if(mysql_num_rows($result)>=1){
			 echo '<h3>Risultato</h3>';
		 	 echo '
			 <div class="table-responsive" id="2">
				<table class="table" border="1">
				<tr>
				<th>Id articolo</th>
				<th>Referenza</th>
				<th>Modello</th>
				<th>Prezzo</th>
				<th>Codice_C</th>
				<th>Email</th>
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
							  </tr>  ';
				}	
			echo '</table></div>';	
			echo'<h3>Effettua una nuova <a href="./ricercaarticoli.php">RICERCA</a></h3>';		
			}
			else{
			echo "<h3>Non è stato trovato nessun articolo con queste caratteristiche!</h3>";
	        header("Refresh:2; URL=ricercaarticoli.php");
			}
	}
	else{form2();}
	echo '</br></br>';

	if (isset($_POST['submit3'])){
	            if(isset($_POST['Data1']) AND isset($_POST['Data2']) AND isset($_POST['Sesso']) AND isset($_POST['Marca']) AND isset($_POST['Condizione'])){
	                $query= "SELECT a.Titolo,a.Referenza_O,o.Prezzo_nuovo,a.Prezzo,o.Marca,o.Calibro,o.Sesso,o.Carica,a.Nickname_scrittore,a.NomeNegozio,a.Data
					FROM Articolo a JOIN Orologi o ON (a.Referenza_O=o.Referenza)
					WHERE YEAR(a.Data)>='".$_POST['Data1']."' AND YEAR(a.Data)<'".$_POST['Data2']."' AND o.Sesso='".$_POST['Sesso']."' AND o.Marca LIKE '".$_POST['Marca']."%' AND a.Condizione>'".$_POST['Condizione']."'
					ORDER BY a.Data DESC ";
	            
					$ris=mysql_query($query) ;
	           		if($ris){
		           		if(mysql_num_rows($ris)>=1){
		                		 echo '<h3>Risultato</h3>';
							 	 echo '
								 <div class="table-responsive" id="3">
									<table class="table" border="1">
									<tr>
									<th>Titolo</th>
									<th>Referenza</th>
									<th>Prezzo_nuovo</th>
									<th>Prezzo</th>
									<th>Marca</th>
									<th>Calibro</th>
									<th>Sesso</th>
									<th>Carica</th>
									<th>Nickname</th>
									<th>Negozio</th>
									<th>Data</th>
									</tr>
								 ';
							 
								 while($row = mysql_fetch_array($ris)){
									 	echo '
										<tr>
										<td>' . $row['Titolo'] . '</td>
										<td>' . $row['Referenza_O'] . '</td>
										<td>' . $row['Prezzo_nuovo'] . '</td>
										<td>' . $row['Prezzo'] . '</td>
										<td>' . $row['Marca'] . '</td>
										<td>' . $row['Calibro'] . '</td>
										<td>' . $row['Sesso'] . '</td>
										<td>' . $row['Carica'] . '</td>
										<td>' . $row['Nickname_scrittore'] . '</td>
										<td>' . $row['NomeNegozio'] . '</td>
										<td>' . $row['Data'] . '</td>
										</tr>
									 ';
								 }
								 echo '</table></div>';
								 echo'<h3>Effettua una nuova <a href="./ricercaarticoli.php">RICERCA</a></h3>';	

		            	}
			            else{
			                echo "<h3>Non è stato trovato nessun articolo con queste caratteristiche!</h3>";
			                header("Refresh:2; URL=ricercaarticoli.php");
			            }
		       		}
			       	else{
			       		echo "<h3>I campi sono sbagliati!</h3>";
			           	header("Refresh:2; URL=ricercaarticoli.php");
			       	}
		        }
		        else{
	        	    echo "<h3>Non sono stati compilati tutti i campi!</h3>";
	                header("Refresh:2; URL=ricercaarticoli.php");
		        }
	}
	else{form3();
	}
	echo '</br></br>';

	if (isset($_POST['submit4'])){
		if ($_POST['Nickname']!=''){
			$query = "SELECT tempo('".$_POST['Nickname']."') ";
			$result =mysql_query($query);
			if(mysql_num_rows($result)>=1){
					echo '<h3>Data ultimo articolo pubblicato dall utente selezionato</h3>';
			 	 echo '
				 <div class="table-responsive" id="4">
					<table class="table" border="1">
					<tr>
					<th>Data</th>
					</tr>
				 ';

				while($row = mysql_fetch_array($result)){
					echo '<tr>	
						  <td>' . $row[0] . '</td> 	
						  </tr>  ';
				}
				echo '</table></div></br></br>';
				echo'<h3>Effettua una nuova <a href="./ricercaarticoli.php">RICERCA</a></h3>';	
		
			}else{
				echo "<h3>L'utente selezionato non ha inserito ancora un articolo!</h3>";
			    header("Refresh:2; URL=ricercaarticoli.php");
			}
			
		}
	}
	else{form4();}
	echo '</br></br>';


	echo'<h3>Torna <a href="./articoli.php">indietro</a></h3>';
	} //fine controllo su login
}

?>
</div>
<div id="footer">
		 <h5>InTimes Copyright © 2014-2015 </br><a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>



