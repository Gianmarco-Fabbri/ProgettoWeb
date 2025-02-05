document.addEventListener("DOMContentLoaded", async function () {
    console.log("Script venditoreOrdini.js avviato!");

    try {
        const response = await fetch("ajax/venditore/api-venditoreOrdini.php");

        if (!response.ok) {
            throw new Error(`HTTP Error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log("Dati ordini ricevuti:", data);

        const ordiniContainer = document.getElementById("ordiniContainer");

        if (!ordiniContainer) {
            console.error("Errore: Il contenitore degli ordini non è stato trovato.");
            return;
        }

        ordiniContainer.innerHTML = ""; // Pulisce il contenuto precedente

        if (data.length === 0) {
            ordiniContainer.innerHTML = `<p class="text-center fs-4 text-muted">Nessun ordine ricevuto finora.</p>`;
            return;
        }

        data.forEach(ordine => {
            const ordineCard = document.createElement("div");
            ordineCard.classList.add("card", "mb-3", "shadow-sm", "p-3");

            // Genera l'elenco dei prodotti acquistati
            let prodottiHTML = `
                <div class="d-flex flex-column flex-md-row align-items-center gap-3">
                    ${ordine.prodotti.map((prodotto, index, array) => `
                            <img src="img/${prodotto.img}" alt="${prodotto.nome}" class="img-fluid rounded" style="max-height: 200px;">
                            <div class="d-flex flex-column">
                                <strong class="fs-5">${prodotto.nome}</strong>
                                <span class="text-muted">Quantità: ${prodotto.quantita}</span>
                                <span class="fw-bold text-success">€${prodotto.prezzo}</span>
                            </div>
                        ${index < array.length - 1 ? '<hr class="w-100">' : ''}
                    `).join("")}
                </div>
            `;

            const statiOrdine = [
                "Elaborazione Ordine",
                "Partenza Magazzino",
                "Transito Magazzino",
                "In Consegna",
                "Consegnato"
            ];

            let selectOptions = statiOrdine.map(stato => 
                `<option value="${stato}" ${ordine.statoOrdine === stato ? 'selected' : ''}>${stato}</option>`
            ).join("");

            ordineCard.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title text-success">Ordine #${ordine.codiceOrdine}</h5>
                    <p class="card-text"><strong>Cliente:</strong> ${ordine.emailCliente}</p>
                    <p class="card-text"><strong>Prodotti:</strong></p>
                    <ul>${prodottiHTML}</ul>
                    <p class="card-text"><strong>Pagamento:</strong> ${ordine.tipoPagamento}</p>

                    <label for="stato-${ordine.codiceOrdine}" class="fw-bold">Stato:</label>
                    <select id="stato-${ordine.codiceOrdine}" class="form-select stato-ordine" data-codice="${ordine.codiceOrdine}">
                        ${selectOptions}
                    </select>
                </div>
            `;

            ordiniContainer.appendChild(ordineCard);
        });

        // Aggiunge event listener ai select per aggiornare lo stato dell'ordine
        document.querySelectorAll(".stato-ordine").forEach(select => {
            select.addEventListener("change", async function () {
                const codiceOrdine = this.getAttribute("data-codice");
                const statoStringa = this.value;

                // Mappa gli stati a valori TINYINT
                const statiOrdineMap = {
                    "Elaborazione Ordine": 0,
                    "Partenza Magazzino": 1,
                    "Transito Magazzino": 2,
                    "In Consegna": 3,
                    "Consegnato": 4
                };

                const nuovoStato = statiOrdineMap[statoStringa];

                console.log("Aggiornamento stato ordine:", { codiceOrdine, nuovoStato });

                try {
                    const updateResponse = await fetch("ajax/venditore/api-aggiornaStatoOrdine.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ codiceOrdine, statoOrdine: nuovoStato })
                    });

                    const result = await updateResponse.json();
                    console.log("Risultato aggiornamento:", result);

                    if (result.success) {
                        alert("Stato ordine aggiornato con successo!");
                    } else {
                        alert("Errore: " + result.message);
                    }
                } catch (error) {
                    console.error("Errore nell'aggiornamento dello stato dell'ordine:", error);
                    alert("Errore di connessione. Riprova più tardi.");
                }
            });
        });

    } catch (error) {
        console.error("Errore nel caricamento degli ordini:", error);
        document.getElementById("ordiniContainer").innerHTML = `<p class="text-danger text-center">Errore nel recupero degli ordini.</p>`;
    }
});
