-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Tue Jan 21 10:24:46 2025 
-- ********************************************* 


-- Database Section
-- ________________ 
drop database if exists benessereDB; 
create database benessereDB;
use benessereDB;

-- Tables Section
-- _____________ 

create table BENEFICIO (
     codiceProdotto char(10) not null,
     benefici char(10) not null,
     constraint ID_benefici_ID primary key (codiceProdotto, benefici));

create table CARRELLO (
     codiceCarrello char(10) not null,
     constraint ID_CARRELLO_ID primary key (codiceCarrello));

create table CATEGORIA (
     nomeCategoria varchar(50) not null,
     scontoCategoria decimal(4,2),
     inEvidenza boolean not null default false,
     constraint ID_CATEGORIA_ID primary key (nomeCategoria));

create table CLIENTE (
     nome varchar(30) not null,
     cognome varchar(30) not null,
     username varchar(30) not null,
     email char(50) not null,
     password varchar(64) not null,
     telefono char(15) not null,
     codiceCarrello char(10) not null,
     constraint ID_CLIENTE_ID primary key (email));

create table COMPOSIZIONE_CARRELLO (
     codiceCarrello char(10) not null,
     codiceProdotto char(10) not null,
     quantita int not null,
     constraint ID_COMPOSIZIONE_CARRELLO_ID primary key (codiceCarrello, codiceProdotto));

create table COMPOSIZIONE_KIT (
     codiceProdotto1 char(10) not null,
     codiceProdotto2 char(10) not null,
     codiceKit char(10) not null,
     quantitaProdotto1 int not null,
     quantitaProdotto2 int not null,
     constraint ID_COMPOSIZIONE_KIT_ID primary key (codiceProdotto1, codiceProdotto2, codiceKit));

create table COMPOSIZIONE_ORDINE (
     codiceOrdine char(10) not null,
     codiceProdotto char(10) not null,
     quantita int not null,
     constraint ID_COMPOSIZIONE_ORDINE_ID primary key (codiceOrdine, codiceProdotto));

create table KIT (
     codiceKit char(10) not null,
     prezzo float(8,2) not null,
     constraint ID_KIT_ID primary key (codiceKit));

create table NOTIFICA (
     codiceNotifica char(10) not null,
     testoNotifica varchar(500) not null,
     data date not null,
     letta boolean not null default false,
     cliente char(50) not null,
     emailVenditore char(50) not null,
     constraint ID_NOTIFICA_ID primary key (codiceNotifica));

create table OFFERTA (
     codiceOfferta char(10) not null,
     sconto float(4,2) not null,
     codiceProdotto char(10) not null,
     constraint ID_OFFERTA_ID primary key (codiceOfferta));

create table ORDINE (
     codiceOrdine char(10) not null,
     dataOrdine date not null,
     dataSpedizione date not null,
     dataArrivo date not null,
     tipoPagamento varchar(30) not null,
     emailCliente char(50) not null,
     constraint ID_ORDINE_ID primary key (codiceOrdine));

create table PRODOTTO (
     codiceProdotto char(10) not null,
     nome varchar(50) not null,
     prezzo float(8,2) not null,
     dataAggiunta date not null,
     descrizione varchar(500) not null,
     numeroRecensioni int not null,
     dimensione int not null,
     scontoProdotto float(4,2),
     categoria varchar(50) not null,
     constraint ID_PRODOTTO_ID primary key (codiceProdotto));

create table RECENSIONE (
     codiceRecensione char(10) not null,
     testoRecensione varchar(500) not null,
     stelle int not null,
     data date not null,
     emailCliente char(50) not null,
     codiceProdotto char(10) not null,
     constraint ID_RECENSIONE_ID primary key (codiceRecensione));

create table VENDITORE (
     email char(50) not null,
     password varchar(64) not null,
     telefono char(15) not null,
     codiceProdotto char(10) not null,
     constraint ID_VENDITORE_ID primary key (email));


-- Constraints Section
-- ___________________ 
alter table CLIENTE add constraint unique (codiceCarrello);

alter table BENEFICIO add constraint EQU_benef_PRODO
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);

alter table CARRELLO add constraint FK_Carrello_Cliente
    foreign key (codiceCarrello)
    references CLIENTE (codiceCarrello)
    ON DELETE CASCADE;

alter table COMPOSIZIONE_CARRELLO add constraint REF_COMPO_CARRE
     foreign key (codiceCarrello)
     references CARRELLO (codiceCarrello);

alter table COMPOSIZIONE_CARRELLO add constraint REF_COMPO_PRODO_1_FK
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);

alter table COMPOSIZIONE_KIT add constraint REF_COMPO_PRODO_1
     foreign key (codiceProdotto1)
     references PRODOTTO (codiceProdotto);

alter table COMPOSIZIONE_KIT add constraint REF_COMPO_PRODO_2
     foreign key (codiceProdotto2)
     references PRODOTTO (codiceProdotto);

alter table COMPOSIZIONE_KIT add constraint REF_COMPO_KIT_FK
     foreign key (codiceKit)
     references KIT (codiceKit);

alter table COMPOSIZIONE_ORDINE add constraint REF_COMPO_ORDIN
     foreign key (codiceOrdine)
     references ORDINE (codiceOrdine);

alter table COMPOSIZIONE_ORDINE add constraint REF_COMPO_PRODO_FK
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);

alter table NOTIFICA add constraint REF_NOTIF_CLIEN_FK
     foreign key (cliente)
     references CLIENTE (email);

alter table NOTIFICA add constraint REF_NOTIF_VENDI_FK
     foreign key (emailVenditore)
     references VENDITORE (email);

alter table OFFERTA add constraint REF_OFFER_PRODO_FK
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);

alter table ORDINE add constraint REF_ORDIN_CLIEN_FK
     foreign key (emailCliente)
     references CLIENTE (email);

-- Not implemented
-- alter table PRODOTTO add constraint ID_PRODOTTO_CHK
--     check(exists(select * from BENEFICIO
--                  where BENEFICIO.codiceProdotto = codiceProdotto)); 
CREATE TRIGGER TRG_before_update_prodotto
BEFORE UPDATE ON PRODOTTO
FOR EACH ROW
BEGIN
    DECLARE beneficio_count INT;
    
    -- Conta i record nella tabella BENEFICIO con il codiceProdotto uguale al nuovo valore
    SELECT COUNT(*)
    INTO beneficio_count
    FROM BENEFICIO
    WHERE codiceProdotto = NEW.codiceProdotto;

    -- Se non esiste alcun record, blocca l'aggiornamento
    IF beneficio_count = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Errore: codiceProdotto aggiornato non è associato a un beneficio esistente.';
    END IF;
END;


alter table RECENSIONE add constraint REF_RECEN_CLIEN_FK
     foreign key (emailCliente)
     references CLIENTE (email);

alter table RECENSIONE add constraint REF_RECEN_PRODO_FK
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);

alter table VENDITORE add constraint REF_VENDI_PRODO_FK
     foreign key (codiceProdotto)
     references PRODOTTO (codiceProdotto);


-- Index Section
-- _____________ 

create unique index ID_benefici_IND
     on BENEFICIO (codiceProdotto, benefici);

create unique index ID_CARRELLO_IND
     on CARRELLO (codiceCarrello);

create unique index ID_CATEGORIA_IND
     on CATEGORIA (nomeCategoria);

create unique index ID_CLIENTE_IND
     on CLIENTE (email);

create index EQU_CLIEN_CARRE_IND
     on CLIENTE (codiceCarrello);

create unique index ID_COMPOSIZIONE_CARRELLO_IND
     on COMPOSIZIONE_CARRELLO (codiceCarrello, codiceProdotto);

create index REF_COMPO_PRODO_1_IND
     on COMPOSIZIONE_CARRELLO (codiceProdotto);

create unique index ID_COMPOSIZIONE_KIT_IND
     on COMPOSIZIONE_KIT (codiceProdotto, codiceKit);

create index REF_COMPO_KIT_IND
     on COMPOSIZIONE_KIT (codiceKit);

create unique index ID_COMPOSIZIONE_ORDINE_IND
     on COMPOSIZIONE_ORDINE (codiceOrdine, codiceProdotto);

create index REF_COMPO_PRODO_IND
     on COMPOSIZIONE_ORDINE (codiceProdotto);

create unique index ID_KIT_IND
     on KIT (codiceKit);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (codiceNotifica);

create index REF_NOTIF_CLIEN_IND
     on NOTIFICA (cliente);

create index REF_NOTIF_VENDI_IND
     on NOTIFICA (emailVenditore);

create unique index ID_OFFERTA_IND
     on OFFERTA (codiceOfferta);

create index REF_OFFER_PRODO_IND
     on OFFERTA (codiceProdotto);

create unique index ID_ORDINE_IND
     on ORDINE (codiceOrdine);

create index REF_ORDIN_CLIEN_IND
     on ORDINE (emailCliente);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (codiceProdotto);

create index REF_PRODO_CATEG_IND
     on PRODOTTO (categoria);

create unique index ID_RECENSIONE_IND
     on RECENSIONE (codiceRecensione);

create index REF_RECEN_CLIEN_IND
     on RECENSIONE (emailCliente);

create index REF_RECEN_PRODO_IND
     on RECENSIONE (codiceProdotto);

create unique index ID_VENDITORE_IND
     on VENDITORE (email);

create index REF_VENDI_PRODO_IND
     on VENDITORE (codiceProdotto);

