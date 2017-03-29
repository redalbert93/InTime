/*1)[INSERITA IN ricercaarticoli.php]Visualizza gli articoli caricati dal "anno" al "anno" che hanno una condizione maggiore di quella inserita, di sesso M D X, 
di marca con iniziale inserita ,ordinati per prezzo*/

SELECT a.Titolo,a.Referenza_O,o.Prezzo_nuovo,a.Prezzo,o.Marca,o.Calibro,o.Sesso,o.Carica,a.Nickname_scrittore,a.NomeNegozio,a.Data
FROM Articolo a JOIN Orologi o ON (a.Referenza_O=o.Referenza)
WHERE YEAR(a.Data)>='".$_POST['Data1']."' AND YEAR(a.Data)<'".$_POST['Data2']."' AND o.Sesso='".$_POST['Sesso']."' AND o.Marca LIKE '".$_POST['Marca']."%' AND a.Condizione>".$_POST['Condizione']."
ORDER BY a.Prezzo DESC	


/*2)[INSERITA IN statistiche_sito.php]trovare la media delle condizioni e il numero degli articoli totali con marche riconosciute al sito*/
SELECT count(Id),avg(Condizione)
FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
WHERE o.Marca IN (SELECT NomeMarche FROM Vende) 


/*3)[INSERITA IN ricercaarticoli.php ]articoli che hanno uno sconto superiore alla % immessa ordinati per prezzo con una marca venduta da uno dei negozi associati*/
SELECT a.Id,a.Prezzo,o.Prezzo_nuovo,a.Referenza_O,o.Marca,a.Titolo,a.Descrizione,a.Nickname_Scrittore,a.NomeNegozio
FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
WHERE (o.Prezzo_nuovo-a.Prezzo)>=((o.Prezzo_nuovo*".$_POST['Percentuale'].")/100) AND o.Marca IN (SELECT Nome FROM Marche)
ORDER BY a.Prezzo DESC

/*4)[INSERITA IN ricercaarticoli.php] di tutti gli orologi con marca immessa trovare tramite la referenza tutti i rispettivi articoli con
un prezzo sotto il prezzo inserito indicando anche chi li ha messi in vendita ordinati in ordine decrescente per data*/
SELECT o.Marca,o.Modello,o.Calibro,o.Carica,o.Referenza,o.Anno,a.Id,a.Titolo,a.Descrizione,a.NomeNegozio,n.Email
 FROM (Articolo a JOIN Negozio n ON a.NomeNegozio=n.Nome) JOIN Orologi o ON a.Referenza_O=o.Referenza
 WHERE a.Prezzo<".$_POST['Prezzo']." AND o.Marca='".$_POST['Marca']."' AND o.Anno>".$_POST['Anno']."
 ORDER BY a.Data DESC


/*5)[INSERITA IN statistiche_sito.php] cercare il negozio che ha il maggior numero di orologi disponibili in vendita*/
DROP VIEW IF EXISTS narticoli;
CREATE VIEW narticoli AS
SELECT DISTINCT Nome,SUM(Quantita) AS Sommaquantita
from (Articolo JOIN Negozio ON Nome=NomeNegozio)
GROUP BY Nome
ORDER BY Sommaquantita desc

SELECT Nome, MAX(Sommaquantita) AS TotaleMassimo
FROM narticoli


/*6)[INSERITA IN ricercaarticoli.php] trovare articoli marca zenith con cinturino in acciaio del negozio con Nickname inserito nella form*/
DROP VIEW IF EXISTS articolinegozi;
CREATE VIEW articolinegozi AS
SELECT a.Id AS Id,a.Referenza_O AS Referenza,a.Prezzo AS Prezzo,o.Marca AS Marca,o.Modello AS Modello,c.Codice AS Codice_c,c.Materiale AS Materiale, a.NomeNegozio AS NomeNegozio  ,n.Email AS Email
FROM ((Articolo a JOIN Negozio n ON a.NomeNegozio=n.Nome) JOIN Cinturini c ON a.Codice_C=c.Codice) JOIN Orologi o ON a.Referenza_O=o.Referenza
WHERE o.Marca='Zenith' AND c.Materiale='acciaio'


SELECT Id, Referenza, Modello,Prezzo, Codice_C, Email
FROM articolinegozi
WHERE NomeNegozio=(
SELECT Nome
FROM Negozio
WHERE Nickname='Bre67'
)


/*7)[INSERITA IN statistiche_sito.php] Orologio più caro con marca riconosciuta dal sito */
SELECT a.Id,a.Prezzo,a.Condizione,a.Referenza_O,o.Marca,o.Modello,o.Calibro,a.Titolo,a.Descrizione,a.Nickname_Scrittore,a.NomeNegozio
FROM Articolo a JOIN Orologi o ON a.Referenza_O=o.Referenza
WHERE o.Marca IN (SELECT Nome FROM Marche) AND  a.Prezzo=(SELECT MAX(Prezzo) FROM Articolo)


