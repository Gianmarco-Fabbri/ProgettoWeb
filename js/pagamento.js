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
                    // Mostriamo solo immagine, nome e quantita
                    html += `
                      <div class="d-flex align-items-center mb-2">
                        <img src="img/${prodotto.immagine}" 
                             alt="${prodotto.nome}" 
                             style="width:50px; height:auto; margin-right:8px;">
                        <p class="mb-0">${prodotto.nome} x ${prodotto.quantita}</p>
                      </div>
                    `;
                });
                
                // Inseriamo il contenuto generato nel div riepilogo
                riepilogoProdottiElement.innerHTML = html;

                // Mostra il subtotale (o totale) in alto/basso
                // Se vuoi ancora vedere il subtotale cumulativo (anche senza mostrare il prezzo unitario):
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
