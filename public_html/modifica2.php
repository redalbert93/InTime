
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
if(!isset($_SESSION['login']))
    echo '<h2>Impossibile accedere.Prima effettuare il <a href="./login.php">Login</a>.</h2></div>';
else{
    require("conn.php");
    $Id = $_SESSION['Id'];
    if($_SESSION['type']=='Persona'){
        $query = "SELECT Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita FROM Articolo WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
        $result =mysql_query($query);
        if(mysql_num_rows($result)==1){

            $row = mysql_fetch_array($result);
            $Referenza_O = $row[0];
            $Codice_C = $row[1];
            $Titolo = $row[2];
            $Descrizione = $row[3];
            $Prezzo = $row[4];
            $Condizione = $row[5];
            $Quantita = $row[6];   
$self=$_SERVER['PHP_SELF'];
echo <<<END
<form id="form" method="post" action="$self" >
<fieldset>
<div class="spaceform">
<h3>modifica articolo</h3></br>
<b>Referenza </b>

<input type="text" placeholder="Referenza_O" name="Referenza_O" value="$Referenza_O" /></br>
<b>Codice cinturino </b> <input type="text" placeholder="Codice_C" name="Codice_C" value="$Codice_C"/></br>
<b>Titolo </b><input type="text" placeholder="Titolo" name="Titolo"  value="$Titolo"/></br>
<b>Descrizione </b><input type="text" placeholder="Descrizione" name="Descrizione" value="$Descrizione"/></br>
<b>Prezzo </b><input type="text" placeholder="Prezzo" name="Prezzo" value="$Prezzo"/></br>
<b>Condizione (0-10) </b><input type="text" placeholder="Condizione" name="Condizione" value="$Condizione"/></br>
<b>Quantita </b><input type="text" placeholder="Quantita" name="Quantita" value="$Quantita"/></br></br>
<div class="spaceform"><input type="submit" name="submit" value="Modifica">
<input type="reset" value="Cancella"></div>
</br>
</fieldset>
</form>
END;
    if (isset($_POST['submit'])){
                if($_POST['Referenza_O'] != NULL AND $_POST['Codice_C'] == ''){
                    $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."', Codice_C=NULL ,Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
                }
                if($_POST['Referenza_O'] == '' AND $_POST['Codice_C'] != NULL){
                   $query= "UPDATE Articolo SET Referenza_O=NULL,Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
                }
                if($_POST['Referenza_O'] == '' AND $_POST['Codice_C'] == ''){
                    $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."',Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
                }
                if($_POST['Referenza_O'] != NULL AND $_POST['Codice_C'] != NULL){
                   $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."',Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND Nickname_scrittore='".$_SESSION['login']."'";
                }
                
                $ris=mysql_query($query);
               
                if($ris){
                    echo "<h2>aggiornamento dell'articolo in corso....</h2>";
                    header("Refresh:2; URL=miei_articoli.php");
                }
                else{
                    echo "<h2>update articolo fallito!</h2>";
                    header("Refresh:2; URL=modifica2.php");
                }
            } 
            echo'<h3>Consulta le referenze e codici disponibili nel DB <a href="./orologicintdisp.php">QUI</a></h3>';
            echo'<h3>Torna <a href="./modifica.php">indietro</a></h3>';
        }
        else{
            echo "<h2>Id non esistente tra i tuoi articoli!</h2>";
            header("Refresh:2; URL=miei_articoli.php");

        }     


    } /*FINE PERSONA*/
    else{
        /*NEGOZIO*/
         require("conn.php");
         $query="SELECT Nome FROM Negozio WHERE Nickname='".$_SESSION['login']."'";
         $result=mysql_query($query) ;
         $raw = mysql_fetch_array($result);
        
         $query = "SELECT Referenza_O,Codice_C,Titolo,Descrizione,Prezzo,Condizione,Quantita FROM Articolo WHERE Id='".$Id."' AND NomeNegozio='".$raw[0]."'";
         $result =mysql_query($query) ;
         if(mysql_num_rows($result)==1){
             $row = mysql_fetch_array($result);

             $Referenza_O = $row[0];
             $Codice_C = $row[1];
             $Titolo = $row[2];
             $Descrizione = $row[3];
             $Prezzo = $row[4];
             $Condizione = $row[5];
             $Quantita = $row[6];
             $self=$_SERVER['PHP_SELF'];
echo <<<END
<form id="form" method="post" action="$self" >
<fieldset>
<div class="spaceform">
<h3>modifica articolo</h3></br>
<b>Referenza </b><input type="text" placeholder="Referenza_O" name="Referenza_O" value="$Referenza_O" /></br>
<b>Codice cinturino </b> <input type="text" placeholder="Codice_C" name="Codice_C" value="$Codice_C"/></br>
<b>Titolo </b><input type="text" placeholder="Titolo" name="Titolo"  value="$Titolo"/></br>
<b>Descrizione </b><input type="text" placeholder="Descrizione" name="Descrizione" value="$Descrizione"/></br>
<b>Prezzo </b><input type="text" placeholder="Prezzo" name="Prezzo" value="$Prezzo"/></br>
<b>Condizione (0-10) </b><input type="text" placeholder="Condizione" name="Condizione" value="$Condizione"/></br>
<b>Quantita </b><input type="text" placeholder="Quantita" name="Quantita" value="$Quantita"/></br></br>
<div class="spaceform"><input type="submit" name="submit" value="Modifica">
<input type="reset" value="Cancella"></div>
</br>
</fieldset>
</form>
END;
            if (isset($_POST['submit'])){
                if($_POST['Referenza_O'] != NULL AND $_POST['Codice_C'] == ''){
                    $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."', Codice_C=NULL ,Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND NomeNegozio='".$raw[0]."'";
                }
                if($_POST['Referenza_O'] == '' AND $_POST['Codice_C'] != NULL){
                   $query= "UPDATE Articolo SET Referenza_O=NULL,Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND NomeNegozio='".$raw[0]."'";
                }
                if($_POST['Referenza_O'] == '' AND $_POST['Codice_C'] == ''){
                    $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."',Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND NomeNegozio='".$raw[0]."'";
                }
                if($_POST['Referenza_O'] != NULL AND $_POST['Codice_C'] != NULL){
                   $query= "UPDATE Articolo SET Referenza_O='".$_POST['Referenza_O']."',Codice_C='".$_POST['Codice_C']."',Titolo='".$_POST['Titolo']."', Descrizione='".$_POST['Descrizione']."', Prezzo='".$_POST['Prezzo']."', Condizione='".$_POST['Condizione']."', Quantita='".$_POST['Quantita']."' WHERE Id='".$Id."' AND NomeNegozio='".$raw[0]."'";
                }


                $ris=mysql_query($query);
                if($ris){
                    echo "<h2>aggiornamento dell'articolo in corso....</h2>";
                    header("Refresh:2; URL=miei_articoli.php");
                }
                else{
                    echo "<h2>update articolo fallito!</h2>";
                    header("Refresh:2; URL=modifica2.php");
                }
            }
            echo'<h3>Consulta le referenze e codici disponibili nel DB <a href="./orologicintdisp.php">QUI</a></h3>';
             echo'<h3>Torna <a href="./modifica.php">indietro</a></h3>';
            }
            else{
                echo "<h2>Id non essitente tra i tuoi articoli!</h2>";
                header("Refresh:2; URL=miei_articoli.php");
            }
    }
}

echo"</div>";
?>
</div>
<div id="footer">
         <h5>InTimes Copyright © 2014-2015 </br> <a href="mailto:redalbert93@libero.it"> Contattaci</a></h5>
</div>
</body>
</html>