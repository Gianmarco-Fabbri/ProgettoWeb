<?php
class DatabaseHelper {
    private $db;
    
    public function __construct($servername, $username, $password, $dbname, $port) {   
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connessione al db fallita.");
        }
    }
    
    /*KIT CONSIGLIATI*/
    public function getAllKits($n) {
        $stmt = $this->db->prepare("SELECT * FROM KIT ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*CATEGORIE IN EVIDENZA*/
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

    /*PRODOTTI IN OFFERTA*/
    public function getDiscountedProducts($n) {
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE inOfferta = 1 ORDER BY scontoProdotto DESC, prezzo ASC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*RECENSIONI RECENTI*/
    public function getLatestReviews($n) {
        $stmt = $this->db->prepare("SELECT * FROM recensione ORDER BY data DESC, codiceRecensione ASC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*DATI CLIENTE*/
    /*questi dati sono presenti nella pagina del profilo */
    /*include il calcolo dei punti accumulati */
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

    /*PUNTI ACCUMULATI DAL CLIENTE */
    public function getCustomerPoints($email) {
        $stmt = $this->db->prepare("SELECT puntiAccumulati FROM clienti WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['puntiAccumulati'] ?? 0;
    }
  
}
?>