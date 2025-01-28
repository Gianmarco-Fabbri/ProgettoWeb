-- *********************************************
-- * Popolamento del database benessereDB     *
-- *********************************************

USE benessereDB;

-- Popolamento tabella CATEGORIA
INSERT INTO CATEGORIA (nomeCategoria, scontoCategoria, inEvidenza) VALUES
('Bellezza', 0.00, 0),
('Salute', 0.00, 0),
('Profumi', 0.00, 0),
('Casa & Green', 0.00, 0),
('Integratori alimentari', 0.00, 1),
('Skincare', 0.00, 1),
('Oli essenziali', 0.00, 1), 
('Cura capelli', 0.00, 1),
('Saldi', 0.0, 1);

-- Popolamento tabella PRODOTTO
INSERT INTO PRODOTTO (codiceProdotto, nome, prezzo, dataAggiunta, descrizione, numeroRecensioni, dimensione, scontoProdotto, categoria) VALUES
('P0', 'Tappetino Yoga', 20.00, '2025-01-01', 'Tappetino antiscivolo', 15, 2, 10, 'Fitness'),
('P1', 'Olio Essenziale', 15.50, '2025-01-10', 'Aroma rilassante alla lavanda', 10, 1, 25, 'Relax'),
('P2', 'Integratori Vitaminici', 30.00, '2025-01-15', 'Per rafforzare il sistema immunitario', 5, 100, NULL, 'Salute');

-- Popolamento tabella BENEFICIO
INSERT INTO BENEFICIO (codiceProdotto, benefici) VALUES
('P0', 'Antistress'),
('P1', 'Flessibilita'),
('P2', 'Relax');

-- Popolamento tabella CLIENTE
INSERT INTO CLIENTE (nome, cognome, username, email, password, telefono, codiceCarrello) VALUES
('provaNome', 'provaCognome', 'prova', 'nome.cognome@example.com', 'prova1234', '0000000000', 'C0'),
('Lisa', 'Vandi', 'lisav', 'lisavandi@example.com', 'password2', '1112223334', 'C1'), 
('Kevin', 'Shimaj', 'kev', 'kevshi@example.com', 'password3', '2223334445', 'C2'),
('Gianmarco', 'Fabbri', 'gimbo', 'giammifab@example.com', 'password4', '3334445556', 'C3');

-- Popolamento tabella CARRELLO
INSERT INTO CARRELLO (codiceCarrello) VALUES
('C0'),
('C1'),
('C2'),
('C3');

-- Popolamento tabella COMPOSIZIONE_CARRELLO
INSERT INTO COMPOSIZIONE_CARRELLO (codiceCarrello, codiceProdotto, quantita) VALUES
('C0', 'P0', 1),
('C1', 'P1', 2),
('C2', 'P2', 1);

-- Popolamento tabella KIT
INSERT INTO KIT (codiceKit, prezzo) VALUES
('K0', 50.00),
('K1', 35.00)
;

-- Popolamento tabella COMPOSIZIONE_KIT
INSERT INTO COMPOSIZIONE_KIT (codiceProdotto1, codiceProdotto2, codiceKit, quantitaProdotto1, quantitaProdotto2) VALUES
('P0', 'P1', 'K0', 1, 2),
('P1', 'P2', 'K1', 1, 1);

-- Popolamento tabella ORDINE
INSERT INTO ORDINE (codiceOrdine, dataOrdine, dataSpedizione, dataArrivo, tipoPagamento, emailCliente) VALUES
('O0', '2025-01-20', '2025-01-21', '2025-01-25', 'Carta di Credito', 'nome.cognome@example.com');

-- Popolamento tabella COMPOSIZIONE_ORDINE
INSERT INTO COMPOSIZIONE_ORDINE (codiceOrdine, codiceProdotto, quantita) VALUES
('O0', 'P0', 1);

-- Popolamento tabella RECENSIONE
INSERT INTO RECENSIONE (codiceRecensione, testoRecensione, stelle, data, emailCliente, codiceProdotto) VALUES
('R0', 'Ottimo tappetino, molto comodo!', 5, '2025-01-15', 'nome.cognome@example.com', 'P0');

-- Popolamento tabella VENDITORE
INSERT INTO VENDITORE (email, password, telefono, codiceProdotto) VALUES
('venditore@example.com', 'venditorepw', '1111111111', 'P0');

-- Popolamento tabella NOTIFICA
INSERT INTO NOTIFICA (codiceNotifica, testoNotifica, data, letta, cliente, emailVenditore) VALUES
('N0', 'Il tuo ordine è stato spedito.', '2025-01-21', 0, 'nome.cognome@example.com', 'venditore@example.com');

-- Popolamento tabella OFFERTA
INSERT INTO OFFERTA (codiceOfferta, sconto, codiceProdotto) VALUES
('OFF0', 20, 'P2');
