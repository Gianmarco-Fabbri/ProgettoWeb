function aggiornaQuantita(idProdotto, nuovaQuantita) {
    fetch("ajax/carrello/api-aggiorna_quantita.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ "idProdotto": idProdotto, "quantita": nuovaQuantita })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Risposta API:", data);

            const prodottoRiga = document.getElementById(`cart-item-${idProdotto}`);

            if (nuovaQuantita == 0) {
                if (prodottoRiga) {
                    prodottoRiga.remove();
                    console.log(`Prodotto ${idProdotto} rimosso dal DOM.`);
                } else {
                    console.warn(`Elemento con id "cart-item-${idProdotto}" non trovato.`);
                }

                if (document.querySelectorAll("[id^='cart-item-']").length === 0) {
                    document.getElementById("carrello-container").innerHTML = `
                        <p class="text-center text-muted">Il carrello è vuoto.</p>
                    `;
                    /* Nasconde riepilogo ordine */
                    document.getElementById("asideCarrello").style.display = "none";
                }
            }

            aggiornaSubtotale();
        } else {
            alert("Errore nell'aggiornamento della quantità: " + data.message);
        }
    })
    .catch(error => console.error("Errore:", error));
}

/**
 * Aggiorna il subtotale e il totale nel DOM.
 */
function aggiornaSubtotale() {
    fetch("ajax/carrello/api-subtotale.php")
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
    const svuotaCarrelloBtn = document.getElementById("svuotaCarrelloBtn");
    if (svuotaCarrelloBtn) {
        svuotaCarrelloBtn.addEventListener("click", function() {
            if (confirm("Sei sicuro di voler svuotare il carrello?")) {
                fetch('ajax/carrello/api-svuota_carrello.php', {
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

document.addEventListener("DOMContentLoaded", function () {
    caricaPuntiUtente();
});

function caricaPuntiUtente() {
    fetch('ajax/carrello/api-get_punti.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let puntiAccumulati = data.punti;
                let sconto = puntiAccumulati / 100;

                document.getElementById("puntiAccumulati").textContent = puntiAccumulati;
                document.getElementById("scontoPunti").textContent = "€" + sconto.toFixed(2);

                let subtotale = parseFloat(document.getElementById("subtotale").dataset.value);
                let totale = subtotale - sconto;
                if (totale < 0) totale = 0;

                document.getElementById("totale").textContent = "€" + totale.toFixed(2);
            } else {
                console.error("Errore nel recupero punti:", data.error);
            }
        })
        .catch(error => console.error("Errore nella richiesta AJAX:", error));
}