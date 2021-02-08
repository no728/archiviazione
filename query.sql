CREATE table Utenti(
	user_CF varchar(24) NOT NULL, /* 16 -> len CF italiano, 24 -> max len CF straniero */
    user_name varchar(20) NOT NULL,
    user_surname varchar(20) NOT NULL,
    user_pwd varchar(128) NOT NULL,
    user_role varchar(5) NOT NULL,
    PRIMARY KEY (user_CF)
    );
    
INSERT INTO utenti (user_CF, user_name, user_surname, user_pwd, user_role) VALUES ('DRRCST03C30D612Y', 'Cristian', 'D\'Arrigo', '0a3380e6494edf455825792a4328a8ebbf3ff5d2acbcd77b8c4fd81c93eeeb088ca7bc4ec0044e3c73ca91c7d9436746461580f2aaa584efa43c84204d625dad', 'admin');
/* -- utenti aggiunti -- */

DROP TABLE Utenti;

ALTER TABLE Utenti MODIFY COLUMN user_pwd varchar(128) NOT NULL; /* role: 'admin' o 'none' */ 
SELECT * FROM Utenti;

/*
	
	ADMIN PASSWORDS:
		NMKDGI02H03H199U : DiegoNamkhai
		RNTVNI02T17A564R : IvanArienti
*/

SET SQL_SAFE_UPDATES = 0;
DELETE FROM Utenti;  /* WARNING -- CANCELLA TUTTO -- WARNING */
SET SQL_SAFE_UPDATES = 1;