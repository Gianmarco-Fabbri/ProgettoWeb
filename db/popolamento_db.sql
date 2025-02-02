-- *********************************************
-- * Popolamento del database benessereDB     *
-- *********************************************

USE benessereDB;

-- Popolamento tabella PRODOTTO
INSERT INTO prodotto (codiceProdotto, nome, prezzo, dataAggiunta, descrizione, numeroRecensioni, dimensione, scontoProdotto, categoria, inOfferta, img)
VALUES
('P1', 'Crema corpo idratante', 19.99, '2025-02-25', 'Crema idratante per la pelle', 15, 1, NULL, 'Benessere', 0, '../img/prodotto1_novità.png'),
('P2', 'Gel dopopuntura 50ml', 5.99, '2025-02-25', 'Gel lenitivo per punture di insetti', 10, 1, NULL, 'Benessere', 1, '../img/prodotto2_novità.png'),
('P3', 'Contorno occhi', 9.99, '2025-02-25', 'Trattamento per il contorno occhi', 8, 1, NULL, 'Benessere', 0, '../img/prodotto3_novità.png'),
('P4', 'Gel igienizzante mani', 7.99, '2025-02-25', 'Gel antibatterico per mani', 12, 1, NULL, 'Benessere', 0, '../img/prodotto4_novità.png'),
('P5', 'NO FLYING INSECTS', 4.99, '2025-02-25', 'Repellente per insetti volanti', 5, 1, 10.00, 'Benessere', 1, '../img/prodotto1_offerta.png'),
('P6', 'Detergente igienizzante', 7.99, '2025-02-25', 'Detergente per tutte le superfici', 10, 1, 15.00, 'Benessere', 1, '../img/prodotto2_offerta.png'),
('P7', 'Gel corpo riscaldante', 14.99, '2025-02-25', 'Gel riscaldante per il corpo', 7, 1, 5.00, 'Benessere', 1, '../img/prodotto3_offerta.png'),
('P8', 'Crema corpo repellente insetti', 3.99, '2025-02-25', 'Crema idratante con effetto repellente', 6, 1, NULL, 'Benessere', 1, '../img/prodotto4_offerta.png'),
('P9', 'Shampoo rinforzante', 8.99, '2025-02-25', 'Shampoo con cheratina', 12, 1, 5.00, 'Cura capelli', 1, '../img/prodotto5_novità.png'),
('P10', 'Balsamo nutriente', 6.99, '2025-02-25', 'Balsamo per capelli secchi', 10, 1, NULL, 'Cura capelli', 0, '../img/prodotto6_novità.png');

-- Popolamento tabella VENDITORE
INSERT INTO VENDITORE (email, password, telefono, codiceProdotto) VALUES
('venditore@example.com', SHA2('venditorepw', 256), '1111111111', 'P1');

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
('Saldi', 0.00, 1),
('Makeup', 0.00, 1),
('Igiene personale', 0.00, 0),
('Massaggi', 0.00, 1),
('Erboristeria', 0.00, 0),
('Sport & Fitness', 0.00, 1),
('Relax & Benessere', 0.00, 1),
('Cosmetici naturali', 0.00, 1),
('Profumeria', 0.00, 0),
('Trattamenti corpo', 0.00, 1),
('Accessori benessere', 0.00, 0);

-- Popolamento tabella CLIENTE
INSERT INTO CLIENTE (nome, cognome, username, email, password, telefono, codiceCarrello) VALUES
('provaNome', 'provaCognome', 'prova', 'nome.cognome@example.com',  SHA2('prova1234', 256), '0000000000', 'C1'),
('Lisa', 'Vandi', 'lisav', 'lisavandi@example.com', SHA2('password2', 256), '1112223334', 'C2'), 
('Kevin', 'Shimaj', 'kev', 'kevshi@example.com', SHA2('password3', 256), '2223334445', 'C3'),
('Gianmarco', 'Fabbri', 'gimbo', 'giammifab@example.com', SHA2('password4', 256), '3334445556', 'C4'),
('Andrea', 'Rossi', 'andrear', 'andrea.rossi@example.com', SHA2('pass123', 256), '4445556667', 'C5');

-- Popolamento tabella CARRELLO
INSERT INTO CARRELLO (codiceCarrello) VALUES
('C1'),
('C2'),
('C3'),
('C4');

-- Popolamento tabella BENEFICIO
INSERT INTO BENEFICIO (codiceProdotto, benefici) VALUES
('P1', 'Antistress'),
('P2', 'Flessibilita'),
('P3', 'Relax'),
('P4', 'Idratazione profonda'),
('P5', 'Protezione antibatterica'),
('P6', 'Repellente naturale'),
('P7', 'Detersione profonda'),
('P8', 'Effetto riscaldante'),
('P9', 'Protezione contro insetti'),
('P10', 'Capelli forti e sani');

-- Popolamento tabella ORDINE
INSERT INTO ORDINE (codiceOrdine, dataOrdine, dataSpedizione, dataArrivo, tipoPagamento, emailCliente) VALUES
('O1', '2025-01-20', '2025-01-21', '2025-01-25', 'Carta di Credito', 'nome.cognome@example.com'),
('O2', '2025-02-01', '2025-02-02', '2025-02-06', 'PayPal', 'andrea.rossi@example.com');

-- Popolamento tabella COMPOSIZIONE_CARRELLO
INSERT INTO COMPOSIZIONE_CARRELLO (codiceCarrello, codiceProdotto, quantita) VALUES
('C1', 'P1', 2),
('C2', 'P2', 1),
('C3', 'P3', 2),
('C4', 'P4', 1);

-- Popolamento tabella COMPOSIZIONE_ORDINE
INSERT INTO COMPOSIZIONE_ORDINE (codiceOrdine, codiceProdotto, quantita) VALUES
('O1', 'P1', 1),
('O2', 'P4', 1);

-- Popolamento tabella RECENSIONE
INSERT INTO RECENSIONE (codiceRecensione, testoRecensione, stelle, data, emailCliente, codiceProdotto) VALUES
('R1', 'Ottimo tappetino, molto comodo!', 5, '2025-01-15', 'nome.cognome@example.com', 'P1'),
('R2', 'Profumo delicato e persistente!', 5, '2025-02-10', 'andrea.rossi@example.com', 'P6');

-- Popolamento tabella NOTIFICA
INSERT INTO NOTIFICA (codiceNotifica, testoNotifica, data, letta, cliente, emailVenditore) VALUES
('N1', 'Il tuo ordine è stato spedito.', '2025-01-21', 0, 'nome.cognome@example.com', 'venditore@example.com'),
('N2', 'Il tuo ordine è in elaborazione.', '2025-02-02', 0, 'andrea.rossi@example.com', 'venditore@example.com');

-- Popolamento tabella OFFERTA
INSERT INTO OFFERTA (codiceOfferta, sconto, codiceProdotto) VALUES
('OFF1', 20, 'P2'),
('OFF2', 15, 'P9');

INSERT INTO KIT (codiceKit, prezzo, img, nome) VALUES 
('k1','€19.99','kit1.png', 'kit_skin_care'), 
('k2','€15.99','kit2.png', 'kit_dopo_barba'), 
('k3','€9.99','kit3.png', 'kit_balsami'), 
('k4','€19.99','kit4.png', 'kit_maschere_viso');