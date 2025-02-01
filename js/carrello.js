/**
 * Aggiorna la quantità di un prodotto nel carrello.
 * @param {number} idProdotto - L'ID del prodotto da aggiornare.
 * @param {number} nuovaQuantita - La nuova quantità impostata dall'utente.
 */
function aggiornaQuantita(idProdotto, nuovaQuantita) {
    if (nuovaQuantita < 1) {
        alert("La quantità deve essere almeno 1.");
        return;
    }
    
    // Crea i dati formattati in x-www-form-urlencoded
    const formData = new URLSearchParams();
    formData.append('idProdotto', idProdotto);
    formData.append('quantita', nuovaQuantita);

    fetch('ajax/carrello/aggiornaQuantita.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Ricarica la pagina per aggiornare la visualizzazione del carrello
            location.reload();
        } else {
            alert("Errore nell'aggiornamento della quantità: " + data.message);
        }
    })
    .catch(error => console.error('Errore:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    // Listener per lo svuotamento del carrello
    const svuotaCarrelloBtn = document.getElementById("svuotaCarrelloBtn");
    if (svuotaCarrelloBtn) {
        svuotaCarrelloBtn.addEventListener("click", function() {
            if (confirm("Sei sicuro di voler svuotare il carrello?")) {
                fetch('ajax/carrello/svuotaCarrello.php', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Errore durante lo svuotamento del carrello: " + data.message);
                    }
                })
                .catch(error => console.error('Errore:', error));
            }
        });
    }

    // (Opzionale) Listener per l'applicazione dei punti.
    // Assicurati di aver aggiunto l'id "applicaPuntiBtn" al pulsante "Applica" nel template.
    const applicaPuntiBtn = document.getElementById("applicaPuntiBtn");
    if (applicaPuntiBtn) {
        applicaPuntiBtn.addEventListener("click", function() {
            const puntiInput = document.getElementById("points");
            const punti = puntiInput.value.trim();
            if (punti === "") {
                alert("Inserisci un valore per i punti.");
                return;
            }
            const formData = new URLSearchParams();
            formData.append('punti', punti);
            fetch('ajax/carrello/applicaPunti.php', { // Endpoint da implementare lato server
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Errore nell'applicazione dei punti: " + data.message);
                }
            })
            .catch(error => console.error('Errore:', error));
        });
    }
});
