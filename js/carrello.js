/**
 * Aggiorna la quantità di un prodotto nel carrello e ricalcola il subtotale.
 * @param {string} idProdotto - L'ID del prodotto da aggiornare.
 * @param {number} nuovaQuantita - La nuova quantità impostata dall'utente.
 */
function aggiornaQuantita(idProdotto, nuovaQuantita) {
    if (nuovaQuantita < 1) {
        if (confirm("Vuoi rimuovere il prodotto dal carrello?")) {
            rimuoviProdotto(idProdotto);
            return;
        } else {
            return;
        }
    }

    fetch("ajax/carrello/aggiornaQuantita.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ "idProdotto": idProdotto, "quantita": nuovaQuantita })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            aggiornaSubtotale();
        } else {
            alert("Errore nell'aggiornamento della quantità: " + data.message);
        }
    })
    .catch(error => console.error("Errore:", error));
}

/**
 * Rimuove un prodotto dal carrello se la quantità è 0.
 * @param {string} idProdotto - L'ID del prodotto da rimuovere.
 */
function rimuoviProdotto(idProdotto) {
    fetch("ajax/carrello/rimuoviProdotto.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ "idProdotto": idProdotto }).toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`article-${idProdotto}`).remove();
            aggiornaSubtotale();
        } else {
            alert("Errore nella rimozione del prodotto: " + data.message);
        }
    })
    .catch(error => console.error("Errore:", error));
}

/**
 * Aggiorna il subtotale e il totale nel DOM.
 */
function aggiornaSubtotale() {
    fetch("ajax/carrello/calcolaSubtotale.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Aggiorna il subtotale
                document.getElementById("subtotale").textContent = "€" + data.subtotale.toFixed(2);
                // Aggiorna il totale (sottraendo lo sconto)
                const sconto = 1.52; // Lo sconto è fisso
                const totale = data.subtotale - sconto;
                document.getElementById("totale").textContent = "€" + totale.toFixed(2);
            } else {
                alert("Errore nel calcolo del subtotale: " + data.message);
            }
        })
        .catch(error => console.error("Errore:", error));
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
