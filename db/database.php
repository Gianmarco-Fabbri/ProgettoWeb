<?php
class DatabaseHelper {
    private $db;
    
    public function __construct($servername, $username, $password, $dbname, $port) {   
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connessione al db fallita.");
        }
    }
    
    /* KIT CONSIGLIATI */
    public function getAllKits($n) {
        $stmt = $this->db->prepare("SELECT * FROM KIT ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* CATEGORIE IN EVIDENZA */
    public function getFeaturedCategories($n) {
        $stmt = $this->db->prepare("SELECT nomeCategoria FROM CATEGORIA WHERE inEvidenza = 1 ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*PRODOTTI NOVITA'*/
    public function getLatestProducts($n) {
        $stmt = $this->db->prepare("SELECT * FROM prodotti ORDER BY dataAggiunta DESC, codiceProdotto ASC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* PRODOTTI IN OFFERTA */
    public function getDiscountedProducts($n) {
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE inOfferta = 1 ORDER BY scontoProdotto DESC, prezzo ASC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* RECENSIONI RECENTI */
    public function getLatestReviews($n) {
        $stmt = $this->db->prepare("SELECT * FROM recensione ORDER BY data DESC, codiceRecensione ASC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* DATI CLIENTE */
    public function getClienteData($email) {
        $stmt = $this->db->prepare("
            SELECT nome, cognome, email, telefono, codiceCarrello 
            FROM cliente
            WHERE email = ?
        ");
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc(); // Restituisce un array associativo con i dati del cliente
    }

    /* CREAZIONE CLIENTE */
    public function createCliente($firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode) {
        $stmt = $this->db->prepare("
            INSERT INTO cliente (nome, cognome, username, email, password, telefono, codiceCarrello, puntiAccumulati) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0)
        ");
        $stmt->bind_param("sssssss", $firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode);
        return $stmt->execute();
    }

    /* questi dati sono presenti nella pagina del profilo */
    /* include il calcolo dei punti accumulati */
    public function updateCustomerPoints($codiceOrdine) {
        // Recupera l'email del cliente dall'ordine
        $sql = "SELECT cliente.email, SUM(prodotto.prezzo * composizione_ordine.quantita) AS totale_spesa 
                FROM composizione_ordine
                JOIN prodotto ON composizione_ordine.codiceProdotto = prodotto.codiceProdotto
                JOIN ordine ON composizione_ordine.codiceOrdine = ordine.codiceOrdine
                JOIN cliente ON ordine.emailCliente = cliente.email
                WHERE composizione_ordine.codiceOrdine = ?
                GROUP BY cliente.email";
    
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param('s', $codiceOrdine);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                $emailCliente = $row['email'];
                $puntiDaAggiungere = floor($row['totale_spesa']); // 1€ = 1 punto
    
                // Aggiorna i punti accumulati del cliente
                $updateSql = "UPDATE cliente SET puntiAccumulati = puntiAccumulati + ? WHERE email = ?";
                if ($updateStmt = $this->db->prepare($updateSql)) {
                    $updateStmt->bind_param('is', $puntiDaAggiungere, $emailCliente);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
            }
            $stmt->close();
        }
    }

    /* PUNTI ACCUMULATI DAL CLIENTE */
    public function getCustomerPoints($email) {
        $stmt = $this->db->prepare("SELECT puntiAccumulati FROM cliente WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['puntiAccumulati'] ?? 0;
    }

    /* RECENSIONI LASCIATE DAL CLIENTE */
    public function getCustomerReviews($email) {
        $stmt = $this->db->prepare("SELECT codiceRecensione, testoRecensione, stelle, data, codiceProdotto FROM recensione WHERE emailCliente = ? ORDER BY data DESC");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* DATI VENDITORE */
    public function getVenditoreData($email) {
        $stmt = $this->db->prepare("
            SELECT email, nome, cognome, telefono 
            FROM venditori 
            WHERE email = ?
        ");
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc(); 
    }
    
    /* PRODOTTI NEL CARRELLO */
    public function getCartProducts($codiceCarrello) {
        $stmt = $this->db->prepare("
            SELECT prodotti.codiceProdotto, prodotti.nome, prodotti.prezzo, prodotti.img, carrello.quantita 
            FROM carrello 
            JOIN prodotti ON carrello.codiceProdotto = prodotti.codiceProdotto
            WHERE carrello.codiceCarrello = ?
        ");
        
        $stmt->bind_param('s', $codiceCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* NOTIFICHE NON LETTE */
    public function getUnreadNotifications($emailCliente) {
        $stmt = $this->db->prepare("
            SELECT codiceNotifica, testoNotifica, data 
            FROM notifiche 
            WHERE cliente = ? AND letta = 0
            ORDER BY data DESC
        ");
        
        $stmt->bind_param('s', $emailCliente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }    
    
    /* NOTIFICA LETTA */
    public function getReadNotifications($emailCliente) {
        $stmt = $this->db->prepare("
            SELECT codiceNotifica, testoNotifica, data 
            FROM notifiche 
            WHERE cliente = ? AND letta = 1
            ORDER BY data DESC
        ");
        
        $stmt->bind_param('s', $emailCliente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /* ORDINI DI UN CLIENTE */
    public function getCustomerOrders($emailCliente) {
        $stmt = $this->db->prepare("
            SELECT ordini.codiceOrdine, ordini.dataOrdine, ordini.dataSpedizione, ordini.dataArrivo, ordini.tipoPagamento, 
                   prodotti.codiceProdotto, prodotti.nome, prodotti.prezzo, composizione_ordine.quantita
            FROM ordini
            JOIN composizione_ordine ON ordini.codiceOrdine = composizione_ordine.codiceOrdine
            JOIN prodotti ON composizione_ordine.codiceProdotto = prodotti.codiceProdotto
            WHERE ordini.emailCliente = ?
            ORDER BY ordini.dataOrdine DESC
        ");
        
        $stmt->bind_param('s', $emailCliente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /* CATEGORIE SALUTE */
    public function getSaluteCategories() {
        $stmt = $this->db->prepare("
            SELECT nomeCategoria, scontoCategoria, inEvidenza 
            FROM categoria 
            WHERE nomeCategoria LIKE '%Salute%'
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /* CATEGORIE BELLEZZA */
    public function getBellezzaCategories() {
        $stmt = $this->db->prepare("
            SELECT nomeCategoria, scontoCategoria, inEvidenza 
            FROM categoria 
            WHERE nomeCategoria LIKE '%Bellezza%'
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /* CATEGORIE PROFUMI */
    public function getProfumiCategories() {
        $stmt = $this->db->prepare("
            SELECT nomeCategoria, scontoCategoria, inEvidenza 
            FROM categoria 
            WHERE nomeCategoria LIKE '%Profumi%'
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /* CATEGORIE CASA & GREEN */
    public function getHomeGreenCategories() {
        $stmt = $this->db->prepare("
            SELECT nomeCategoria, scontoCategoria, inEvidenza 
            FROM categoria 
            WHERE nomeCategoria LIKE '%Casa & Green%'
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarrelloByCode($cartCode) {
        $stmt = $this->db->prepare("SELECT codiceCarrello FROM cliente WHERE codiceCarrello = ?");
        $stmt->bind_param("s", $cartCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
}   
?>