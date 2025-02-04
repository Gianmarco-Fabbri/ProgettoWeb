document.addEventListener("DOMContentLoaded", function () {
    const tipoSpedizione = document.getElementById("tipo-spedizione");
    const totaleElement = document.getElementById("totale");
    const dataConsegnaElement = document.getElementById("data-consegna");
    const riepilogoProdottiElement = document.getElementById("riepilogo-prodotti");

    if (!tipoSpedizione || !totaleElement || !dataConsegnaElement || !riepilogoProdottiElement) {
        console.error("Errore: Elementi della pagina mancanti!");
        return;
    }

    // Carica riepilogo prodotti e totale ordine con sconto punti
    fetch("ajax/pagamento/api-riepilogo.php")
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let html = "";
            data.prodotti.forEach(prodotto => {
                html += `
                <div class="d-flex align-items-center mb-2">
                    <img src="img/${prodotto.immagine}" 
                        class="img-fluid rounded"
                        alt="${prodotto.nome}" 
                        style="width:50px; height:50px; object-fit:cover;">
                    <p class="mb-0 ms-2">${prodotto.nome} x ${prodotto.quantita}</p>
                </div>
                `;
            });

            riepilogoProdottiElement.innerHTML = html;
            document.getElementById("subtotale").textContent = `${data.subtotale.toFixed(2)} €`;
            document.getElementById("scontoPunti").textContent = `-€${data.scontoPunti.toFixed(2)}`;
            totaleElement.textContent = `${data.totale.toFixed(2)} €`;
        } else {
            console.error("Errore nel caricamento del riepilogo:", data.message);
        }
    })
    .catch(error => console.error("Errore durante il caricamento del riepilogo:", error));

    
    tipoSpedizione.addEventListener("change", function () {
        const tipoSpedizioneValore = tipoSpedizione.value;
    
        fetch(`ajax/pagamento/api-calcola_totale.php?spedizione=${tipoSpedizioneValore}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Aggiorna subtotale, costo spedizione, sconto punti e totale
                    document.getElementById("subtotale").textContent = `${data.subtotale.toFixed(2)} €`;
                    document.getElementById("scontoPunti").textContent = `-€${data.scontoPunti.toFixed(2)}`;
                    totaleElement.textContent = `${data.totale.toFixed(2)} €`;
                } else {
                    console.error("Errore nel calcolo del totale:", data.message);
                }
            })
            .catch(error => console.error("Errore durante il calcolo del totale:", error));    

        fetch(`ajax/pagamento/api-consegna.php?spedizione=${tipoSpedizioneValore}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    dataConsegnaElement.textContent = data.dataConsegna;
                } else {
                    console.error("Errore nell'aggiornamento della data di consegna:", data.message);
                }
            })
            .catch(error => console.error("Errore durante l'aggiornamento della data di consegna:", error));
    });

    // Gestione pagamento
    const buttonAcquisto = document.getElementById("procediPagamento");
    if (!buttonAcquisto) {
        console.error("Errore: Il pulsante di pagamento non esiste!");
        return;
    }

    buttonAcquisto.addEventListener("click", function () {
        const tipoPagamento = document.getElementById("tipo-carta").value;
        let dataArrivo = document.getElementById("data-consegna").textContent.trim();

        let formattedDate = "";
        try {
            const dateObj = new Date(dataArrivo);
            if (!isNaN(dateObj.getTime())) {
                formattedDate = dateObj.toISOString().split("T")[0];
            } else {
                throw new Error("Data non valida");
            }
        } catch (error) {
            alert("Errore nella conversione della data di arrivo.");
            return;
        }

        fetch("ajax/pagamento/api-acquista.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `tipoPagamento=${encodeURIComponent(tipoPagamento)}&dataArrivo=${encodeURIComponent(formattedDate)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Ordine completato! Numero ordine: " + data.codiceOrdine);

                // Aggiorna la visualizzazione dei punti fedeltà
                caricaPuntiUtente();

                // Reindirizza alla pagina ordini dopo 1.5 secondi
                setTimeout(() => {
                    window.location.href = "ordini.php";
                }, 1500);
            } else {
                alert("Errore durante l'acquisto: " + data.message);
            }
        })
        .catch(error => console.error("Errore:", error));
    });
});

function caricaPuntiUtente() {
    fetch('ajax/carrello/api-get_punti.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let puntiElem = document.getElementById("puntiAccumulati");
                let scontoElem = document.getElementById("scontoPunti");
                let subtotaleElem = document.getElementById("subtotale");
                let totaleElem = document.getElementById("totale");

                if (!subtotaleElem || !totaleElem) {
                    console.error("Errore: Elementi del riepilogo ordine mancanti!");
                    return;
                }

                let subtotale = parseFloat(subtotaleElem.dataset.value);
                let punti = data.punti;
                let sconto = punti / 100; // 100 punti = 1€

                if (puntiElem) puntiElem.textContent = punti;
                if (scontoElem) scontoElem.textContent = "-€" + sconto.toFixed(2);

                let totale = subtotale - sconto;
                if (totale < 0) totale = 0; // Il totale non può essere negativo

                totaleElem.textContent = "€" + totale.toFixed(2);
            } else {
                console.error("Errore nel recupero punti:", data.error);
            }
        })
        .catch(error => console.error("Errore durante la richiesta AJAX:", error));
}
