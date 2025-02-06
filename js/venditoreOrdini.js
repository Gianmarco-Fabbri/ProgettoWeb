document.addEventListener("DOMContentLoaded", async function () {
    console.log("Script venditoreOrdini.js avviato!");

    const ordiniContainer = document.getElementById("ordiniContainer");
    if (!ordiniContainer) {
        console.error("Errore: Il contenitore degli ordini non è stato trovato.");
        return;
    }

    try {
        const response = await fetch("ajax/venditore/api-venditoreOrdini.php");
        if (!response.ok) throw new Error(`HTTP Error! Status: ${response.status}`);
        
        const data = await response.json();
        console.log("Dati ordini ricevuti:", data);
        ordiniContainer.innerHTML = ""; // Pulisce il contenuto precedente

        if (data.length === 0) {
            ordiniContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="alert alert-success" style="background-color: #f4fbf8; border-color: #0a5738;">
                        <h2 class="alert-heading" style="color: #0a5738;">Nessun ordine effettuato</h2>
                        <p style="color: #0a5738;">Inizia a fare acquisti nel nostro negozio!</p>
                        <a href="venditore.php" class="btn btn-success" style="background-color: #0a5738; border-color: #0a5738;">
                            Ritorna alla Home
                        </a>
                    </div>
                </div>`;
            return;
        }

        const statiOrdine = [
            "Elaborazione Ordine", "Partenza Magazzino", "Transito Magazzino", "In Consegna", "Consegnato"
        ];
        
        data.forEach(ordine => {
            let stato = statiOrdine[ordine.statoOrdine] || "Sconosciuto";
            
            const cardHTML = `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-success shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title text-success fs-5 fs-md-4" style="color: #0a5738!important;">
                                Ordine #${ordine.codiceOrdine}
                            </h2>
                            <p class="text-muted mb-1">Cliente: ${ordine.emailCliente}</p>
                            <p class="text-muted mb-1">Pagamento: ${ordine.tipoPagamento}</p>
                            <ul class="list-unstyled">
                                ${ordine.prodotti.map(prodotto => `
                                    <li>
                                        <img src="img/${prodotto.img}" alt="${prodotto.nome}" class="img-fluid rounded" style="max-height: 50px;">
                                        ${prodotto.nome} (x${prodotto.quantita}) - €${prodotto.prezzo}
                                    </li>
                                `).join("")}
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge rounded-pill" style="background-color: #0a5738; color: #f4fbf8;">
                                    ${stato}
                                </span>
                                <select class="form-select stato-ordine" data-codice="${ordine.codiceOrdine}">
                                    ${statiOrdine.map(statoOption => `
                                        <option value="${statoOption}" ${ordine.statoOrdine === statoOption ? 'selected' : ''}>${statoOption}</option>
                                    `).join("")}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>`;
            
            ordiniContainer.innerHTML += cardHTML;
        });

        // Event listener per aggiornare lo stato dell'ordine
        document.querySelectorAll(".stato-ordine").forEach(select => {
            select.addEventListener("change", async function () {
                const codiceOrdine = this.getAttribute("data-codice");
                const statoStringa = this.value;
                
                const statiOrdineMap = {
                    "Elaborazione Ordine": 1,
                    "Partenza Magazzino": 2,
                    "Transito Magazzino": 3,
                    "In Consegna": 4,
                    "Consegnato": 5
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
        ordiniContainer.innerHTML = `<p class="text-danger text-center">Errore nel recupero degli ordini.</p>`;
    }
});