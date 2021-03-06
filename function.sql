/*FUNZIONI*/

/*1)Funzione INSERITA IN STATISTICHE SITO che ritorna il numero degli articoli messi in vendita quest'ultimo mese*/
DROP FUNCTION IF EXISTS ultimiorologi;
DELIMITER //
CREATE FUNCTION ultimiorologi() RETURNS INT
BEGIN
	DECLARE conta INT DEFAULT 0;
	SELECT COUNT(*) INTO conta
	FROM Articolo
	WHERE DATEDIFF(NOW(),Data)<30;
	RETURN conta;
END;


/* 2)procedura per inserire il cinturino con codice passato per valore all'articolo con id passato per valore pubblicato dall'utente con Nickname passato per valore*/

DROP PROCEDURE IF EXISTS cinturino;
DELIMITER //
CREATE PROCEDURE cinturino (IN Id_art INT(4),IN Cinturino CHAR(3),IN Nickname VARCHAR(20))
BEGIN
DECLARE cod CHAR(3);
SELECT Codice_C INTO cod
FROM Articolo
WHERE Id=Id_art;
IF cod IS NULL THEN
	UPDATE Articolo
	SET Codice_C=Cinturino
	WHERE Nickname_Scrittore = Nickname AND Id=Id_art;
END IF;
END;

/*3)[INSERITA IN ricercaarticolo.php] Funzione che ritorna la data dell'ultimo articolo pubblicato dall'utente con Nickname passato per valore*/
DROP FUNCTION IF EXISTS tempo
DELIMITER //
CREATE FUNCTION tempo(Nickname VARCHAR(20)) RETURNS TIMESTAMP
BEGIN
	DECLARE dataultimoart TIMESTAMP;
	SELECT MAX(Data) INTO dataultimoart
	FROM Articolo
	WHERE Nickname_Scrittore = Nickname;
	RETURN dataultimoart;
END;
