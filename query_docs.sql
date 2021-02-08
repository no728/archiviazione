/*

Le proprietà di TUTTI i documenti sono: Tipologia, Categoria, Indice, Anno
A queste proprietà si aggiungeranno un nome del documento (non univoco) e la locazione sul server del file in formato PDF.
I documenti verranno identificati da un ID univoco.

Es.
	Nome							PercorsoFile						Tipologia		Categoria		Indice		Anno
	
    Sciopero del gg/mm/aa			../assenza_mario_rossi_20160125.pdf	tipologia		categoria		indice		aa

*/

CREATE TABLE DocumentiAmministrazione(
	documentID int NOT NULL AUTO_INCREMENT,
    document_name varchar(30) NOT NULL,
    pathToFile varchar(50) NOT NULL,
    document_category varchar(53) NOT NULL, /* il valore più lungo che questo campo può acquisire è
											{'B1 - documentazione ufficiale dell'attività didattica'} */
    document_index smallint NOT NULL,
    document_day smallint NOT NULL,
    document_month smallint NOT NULL,
    document_year int NOT NULL,
    PRIMARY KEY (documentID)
);

CREATE TABLE DocumentiDidattica(
	documentID int NOT NULL AUTO_INCREMENT,
    document_name varchar(30) NOT NULL,
    pathToFile varchar(100) NOT NULL,
    document_category varchar(53) NOT NULL, /* il valore più lungo che questo campo può acquisire è
											{'B1 - documentazione ufficiale dell'attività didattica'} */
    document_index smallint NOT NULL,
    document_day smallint NOT NULL,
    document_month smallint NOT NULL,
    document_year int NOT NULL,
    PRIMARY KEY (documentID)
);

ALTER TABLE DocumentiAmministrazione AUTO_INCREMENT = 1;
ALTER TABLE DocumentiDidattica AUTO_INCREMENT = 1;
SELECT * FROM DocumentiAmministrazione;
DELETE FROM DocumentiAmministrazione;
DROP TABLE DocumentiDidattica;
ALTER TABLE DocumentiDidattica MODIFY COLUMN document_name varchar(75);
INSERT INTO DocumentiAmministrazione (document_name, pathToFile, document_category, document_index, document_day, document_month, document_year) VALUES ('d', '../docs/1.pdf', 'A1 – Norme, disposizioni organizzative e ispezioni', 1, 02, 10, 20);