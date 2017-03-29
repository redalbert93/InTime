
/*Questo trigger si attiva prima di fare un inserimento nella tabella articolo, quando omettiamo la quantità la setta di 
default a 1 , controlla che sia inserita almeno una referenza di un orologio o un codice di un cinturino, controlla che siano 
inseriti un titolo e una descrizione e se viene immessa una referenza di un orologio, controlla che il prezzo dell'articolo non 
sia maggiore del prezzo di listino, controlla che se viene inserito un orologio da tasca non puo' essere inserito un cinturino. */

CREATE TRIGGER ControlloArticoloINS
BEFORE INSERT ON Articolo
FOR EACH ROW
BEGIN
	IF(New.Quantita = '' OR New.Quantita<=0) THEN 
		SET New.Quantita=0;
	END IF;
	IF(New.Codice_C = '' AND New.Referenza_O = '') THEN
		CALL `errore articolo`;
	END IF;
	IF(New.Titolo = '' OR New.Descrizione = '') THEN
		CALL `errore articolo`;
	END IF;
	IF(New.Codice_C IS NOT NULL AND New.Referenza_O = (SELECT Orologi.Referenza FROM Orologi WHERE Orologi.Referenza=New.Referenza_O AND Orologi.Tipo="tasca")) THEN 
		CALL `errore articolo`;
	END IF;
	IF(New.Referenza_O IS NOT NULL) THEN
		IF(New.Prezzo  > (SELECT Orologi.Prezzo_nuovo FROM Orologi WHERE Orologi.Referenza=New.Referenza_O)) THEN
				CALL `errore prezzi`;
		END IF;
	END IF;
END $$

/*Questo trigger si attiva prima di fare un update nella tabella articolo, quando la quantità è <=0 la setta di 
default a 0 , controlla che sia inserita almeno una referenza di un orologio o un codice di un cinturino, controlla che siano 
inseriti un titolo e una descrizione e se viene immessa una referenza di un orologio, controlla che il prezzo dell'articolo non 
sia maggiore del prezzo di listino, controlla che se viene inserito un orologio da tasca non puo' essere inserito un cinturino.*/

CREATE TRIGGER ControlloArticoloUPD
BEFORE UPDATE ON Articolo
FOR EACH ROW
BEGIN
	IF(New.Quantita <= 0) THEN 
		SET New.Quantita=0;
	END IF;
	IF(New.Codice_C = '' AND New.Referenza_O = '') THEN
		CALL `errore articolo`;
	END IF;
	IF(New.Titolo='' OR New.Descrizione='') THEN
		CALL `errore articolo`;
	END IF;	
	IF(New.Codice_C IS NOT NULL AND New.Referenza_O = (SELECT Orologi.Referenza FROM Orologi WHERE Orologi.Referenza=New.Referenza_O AND Orologi.Tipo="tasca")) THEN 
		CALL `errore articolo`;
	END IF;
	IF(New.Referenza_O IS NOT NULL) THEN
		IF(New.Prezzo  > (SELECT Orologi.Prezzo_nuovo FROM Orologi WHERE Orologi.Referenza=New.Referenza_O)) THEN
				CALL `errore prezzi`;
		END IF;
	END IF;
END $$


/*Questo trigger fa un doppio controllo in inserimento sulla tabella Orologi. Verifica che il diametro immesso non sia >48 (massimo diametro 
per un orologio) e che un orologio da tasca non può avere una carica automatica o al quarzo,in questo modo viene controllata 
la generalizzazione fatta nello schema ER e se il nuovo orologio è un orologio da polso setta la catena come non presente di default.
*/
CREATE TRIGGER ControlloOrologioINS
BEFORE INSERT ON Orologi                   
FOR EACH ROW 
BEGIN
	IF(New.Diametro > 48) THEN
    	CALL `errore diametro`;
    END IF;
    IF(New.Tipo = "tasca" AND (New.Carica = "automatico" OR New.Carica = "quarzo")) THEN
		CALL `controllare tipo e carica`;
	END IF;
	IF(New.Tipo = "polso") THEN
		SET New.Catena = "non presente";
	END IF;
END $$

/*Questo trigger fa un doppio controllo in Update sulla tabella Orologi. Verifica che il diametro immesso non sia >48 (massimo diametro 
per un orologio) e che un orologio da tasca non può avere una carica automatica o al quarzo,in questo modo viene controllata 
la generalizzazione fatta nello schema ER e se il nuovo orologio è un orologio da polso setta la catena come non presente di default.
*/
CREATE TRIGGER ControlloOrologioUPD
BEFORE UPDATE ON Orologi 
FOR EACH ROW 
BEGIN
	IF(New.Diametro > 48) THEN
    	CALL `errore diametro`;
    END IF;
   	IF(New.Tipo = "tasca" AND (New.Carica = "automatico" OR New.Carica = "quarzo")) THEN
		CALL `controllare tipo e carica`;
	END IF;
	IF(New.Tipo = "polso") THEN
		SET New.Catena = "non presente";
	END IF;
END $$

/*Questo trigger controlla che la password vecchia non sia uguale a quella nuova in caso di change-password*/
CREATE TRIGGER ControllopswUPD 
BEFORE UPDATE ON Persona
FOR EACH ROW 
BEGIN
  IF (NEW.Password = OLD.Password) THEN 
        CALL `psw vecchia uguale alla nuova`;
  END IF;
END $$

/*Questo trigger si attiva quando un utente esterno effettua l'iscrizione al sito, controlla che tutti i campi siano stati compilati*/

CREATE TRIGGER ControlloiscrizioneINS 
BEFORE INSERT ON Persona
FOR EACH ROW 
BEGIN
  IF (NEW.Nickname = '' OR NEW.Password = MD5('') OR New.Nome = '' OR New.Cognome = '' OR New.Email = '') THEN
        CALL `compilare i campi`;
		END IF;
END $$

/*Questo trigger si attiva quando facciamo un'iscrizione di un negozio, controlla che tutti i campi obbligatori siano compilati, in caso 
  negativo impedisce l'update*/

CREATE TRIGGER ControllonegoziUPD 
BEFORE UPDATE ON Negozio
FOR EACH ROW 
BEGIN
  IF (NEW.Password = OLD.Password) THEN 
        CALL `psw vecchia uguale alla nuova`;
  END IF;
END $$

/*Questo trigger si attiva quando facciamo un'iscrizione di un negozio, controlla che tutti i campi obbligatori siano compilati, in caso 
  negativo impedisce l'inserimento*/
CREATE TRIGGER ControllonegoziINS 
BEFORE INSERT ON Negozio
FOR EACH ROW 
BEGIN
  IF (NEW.Nickname = '' OR NEW.Password = MD5('') OR New.Nome = '' OR New.Indirizzo = '' OR New.Telefono = '' OR New.Email = '') THEN
        CALL `compilare i campi`;
		END IF;
END $$