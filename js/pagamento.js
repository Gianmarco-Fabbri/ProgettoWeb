document.addEventListener("DOMContentLoaded", function () {
    const tipoSpedizione = document.getElementById("tipo-spedizione");
    const totaleElement = document.getElementById("totale");
    const dataConsegnaElement = document.getElementById("data-consegna");
    const riepilogoProdottiElement = document.getElementById("riepilogo-prodotti");

    // Carica il riepilogo dei prodotti dal server
    fetch("ajax/pagamento/api-riepilogo.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = "";
                data.prodotti.forEach(prodotto => {
                    html += `<p class="mb-2">${prodotto.nome} - ${prodotto.quantita} x ${prodotto.prezzoUnitario.toFixed(2)} € = ${prodotto.prezzoTotale.toFixed(2)} €</p>`;
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

        // Aggiorna il totale
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

        // Aggiorna la data di consegna
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