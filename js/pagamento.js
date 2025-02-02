document.addEventListener("DOMContentLoaded", function () {
    const tipoSpedizione = document.getElementById("tipo-spedizione");
    const totaleElement = document.getElementById("totale");
    const dataConsegnaElement = document.getElementById("data-consegna");
    const riepilogoProdottiElement = document.getElementById("riepilogo-prodotti");

    if (!tipoSpedizione || !totaleElement || !dataConsegnaElement || !riepilogoProdottiElement) {
        console.error("Errore: Elementi della pagina mancanti!");
        return;
    }

    // Carica il riepilogo dei prodotti dal server
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
                totaleElement.textContent = `${data.subtotale.toFixed(2)} €`;
            } else {
                console.error("Errore nel caricamento del riepilogo:", data.message);
            }
        })
        .catch(error => console.error("Errore durante il caricamento del riepilogo:", error));

    // Aggiorna il totale e la data di consegna quando cambia la spedizione
    tipoSpedizione.addEventListener("change", function () {
        const tipoSpedizioneValore = tipoSpedizione.value;

        fetch(`ajax/pagamento/api-calcola_totale.php?spedizione=${tipoSpedizioneValore}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
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
});

document.addEventListener("DOMContentLoaded", function () {
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
                window.location.href = "ordini.php";
            } else {
                alert("Errore durante l'acquisto: " + data.message);
            }
        })
        .catch(error => console.error("Errore:", error));
    });
});
