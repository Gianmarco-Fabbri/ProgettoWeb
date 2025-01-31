-- *********************************************
-- * SQL MySQL generation                      
-- * DB-MAIN version: 11.0.2               
-- * Generator date: Sep 14 2021              
-- * Generation date: Tue Jan 21 10:24:46 2025 
-- *********************************************

-- Drop and recreate the database
DROP DATABASE IF EXISTS benessereDB;
CREATE DATABASE benessereDB;
USE benessereDB;

-- Tables Section
-- Create all tables without foreign keys first
CREATE TABLE BENEFICIO (
    codiceProdotto CHAR(10) NOT NULL,
    benefici VARCHAR(50) NOT NULL,
    CONSTRAINT ID_benefici_ID PRIMARY KEY (codiceProdotto, benefici)
);

CREATE TABLE CARRELLO (
    codiceCarrello CHAR(10) NOT NULL,
    CONSTRAINT ID_CARRELLO_ID PRIMARY KEY (codiceCarrello)
);

CREATE TABLE CATEGORIA (
    nomeCategoria VARCHAR(50) NOT NULL,
    scontoCategoria DECIMAL(4,2),
    inEvidenza BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT ID_CATEGORIA_ID PRIMARY KEY (nomeCategoria)
);

CREATE TABLE CLIENTE (
    nome VARCHAR(30) NOT NULL,
    cognome VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email CHAR(50) NOT NULL,
    password VARCHAR(64) NOT NULL,
    telefono CHAR(15) NOT NULL,
    codiceCarrello CHAR(10) NOT NULL,
    CONSTRAINT ID_CLIENTE_ID PRIMARY KEY (email),
    CONSTRAINT UNQ_codiceCarrello UNIQUE (codiceCarrello)
);

CREATE TABLE COMPOSIZIONE_CARRELLO (
    codiceCarrello CHAR(10) NOT NULL,
    codiceProdotto CHAR(10) NOT NULL,
    quantita INT NOT NULL,
    CONSTRAINT ID_COMPOSIZIONE_CARRELLO_ID PRIMARY KEY (codiceCarrello, codiceProdotto)
);

CREATE TABLE COMPOSIZIONE_ORDINE (
    codiceOrdine CHAR(10) NOT NULL,
    codiceProdotto CHAR(10) NOT NULL,
    quantita INT NOT NULL,
    CONSTRAINT ID_COMPOSIZIONE_ORDINE_ID PRIMARY KEY (codiceOrdine, codiceProdotto)
);

CREATE TABLE KIT (
    codiceKit CHAR(10) NOT NULL,
    prezzo VARCHAR(200) NOT NULL,
    img VARCHAR(200) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    CONSTRAINT ID_KIT_ID PRIMARY KEY (codiceKit)
);

CREATE TABLE NOTIFICA (
    codiceNotifica CHAR(10) NOT NULL,
    testoNotifica VARCHAR(500) NOT NULL,
    data DATE NOT NULL,
    letta BOOLEAN NOT NULL DEFAULT FALSE,
    cliente CHAR(50) NOT NULL,
    emailVenditore CHAR(50) NOT NULL,
    CONSTRAINT ID_NOTIFICA_ID PRIMARY KEY (codiceNotifica)
);

CREATE TABLE OFFERTA (
    codiceOfferta CHAR(10) NOT NULL,
    sconto DECIMAL(4,2) NOT NULL,
    codiceProdotto CHAR(10) NOT NULL,
    CONSTRAINT ID_OFFERTA_ID PRIMARY KEY (codiceOfferta)
);

CREATE TABLE ORDINE (
    codiceOrdine CHAR(10) NOT NULL,
    dataOrdine DATE NOT NULL,
    dataSpedizione DATE NOT NULL,
    dataArrivo DATE NOT NULL,
    tipoPagamento VARCHAR(30) NOT NULL,
    emailCliente CHAR(50) NOT NULL,
    CONSTRAINT ID_ORDINE_ID PRIMARY KEY (codiceOrdine)
);

CREATE TABLE PRODOTTO (
    codiceProdotto CHAR(10) NOT NULL,
    nome VARCHAR(50) NOT NULL,
    prezzo DECIMAL(8,2) NOT NULL,
    dataAggiunta DATE NOT NULL,
    descrizione VARCHAR(500) NOT NULL,
    numeroRecensioni INT NOT NULL,
    dimensione INT NOT NULL,
    scontoProdotto DECIMAL(4,2),
    categoria VARCHAR(50) NOT NULL,
    inOfferta BOOLEAN NOT NULL DEFAULT FALSE,
    img VARCHAR(200) NOT NULL,
    CONSTRAINT ID_PRODOTTO_ID PRIMARY KEY (codiceProdotto)
);

CREATE TABLE RECENSIONE (
    codiceRecensione CHAR(10) NOT NULL,
    testoRecensione VARCHAR(500) NOT NULL,
    stelle INT NOT NULL,
    data DATE NOT NULL,
    emailCliente CHAR(50) NOT NULL,
    codiceProdotto CHAR(10) NOT NULL,
    CONSTRAINT ID_RECENSIONE_ID PRIMARY KEY (codiceRecensione)
);

CREATE TABLE VENDITORE (
    email CHAR(50) NOT NULL,
    password VARCHAR(64) NOT NULL,
    telefono CHAR(15) NOT NULL,
    codiceProdotto CHAR(10) NOT NULL,
    CONSTRAINT ID_VENDITORE_ID PRIMARY KEY (email)
);

-- Add foreign keys after all tables are created
ALTER TABLE BENEFICIO
    ADD CONSTRAINT EQU_benef_PRODO FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

ALTER TABLE CARRELLO
    ADD CONSTRAINT FK_Carrello_Cliente FOREIGN KEY (codiceCarrello) REFERENCES CLIENTE (codiceCarrello) ON DELETE CASCADE;

ALTER TABLE COMPOSIZIONE_CARRELLO
    ADD CONSTRAINT REF_COMPO_CARRE FOREIGN KEY (codiceCarrello) REFERENCES CARRELLO (codiceCarrello),
    ADD CONSTRAINT REF_COMPO_PRODO_1_FK FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

ALTER TABLE COMPOSIZIONE_ORDINE
    ADD CONSTRAINT REF_COMPO_ORDIN FOREIGN KEY (codiceOrdine) REFERENCES ORDINE (codiceOrdine),
    ADD CONSTRAINT REF_COMPO_PRODO_FK FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

ALTER TABLE NOTIFICA
    ADD CONSTRAINT REF_NOTIF_CLIEN_FK FOREIGN KEY (cliente) REFERENCES CLIENTE (email),
    ADD CONSTRAINT REF_NOTIF_VENDI_FK FOREIGN KEY (emailVenditore) REFERENCES VENDITORE (email);

ALTER TABLE OFFERTA
    ADD CONSTRAINT REF_OFFER_PRODO_FK FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

ALTER TABLE ORDINE
    ADD CONSTRAINT REF_ORDIN_CLIEN_FK FOREIGN KEY (emailCliente) REFERENCES CLIENTE (email);

ALTER TABLE RECENSIONE
    ADD CONSTRAINT REF_RECEN_CLIEN_FK FOREIGN KEY (emailCliente) REFERENCES CLIENTE (email),
    ADD CONSTRAINT REF_RECEN_PRODO_FK FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

ALTER TABLE VENDITORE
    ADD CONSTRAINT REF_VENDI_PRODO_FK FOREIGN KEY (codiceProdotto) REFERENCES PRODOTTO (codiceProdotto);

-- Add the trigger
DELIMITER //

CREATE TRIGGER TRG_before_update_prodotto
BEFORE UPDATE ON PRODOTTO
FOR EACH ROW
BEGIN
    DECLARE beneficio_count INT;

    SELECT COUNT(*)
    INTO beneficio_count
    FROM BENEFICIO
    WHERE codiceProdotto = NEW.codiceProdotto;

    IF beneficio_count = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Errore: codiceProdotto aggiornato non è associato a un beneficio esistente.';
    END IF;
END;
//

DELIMITER ;
