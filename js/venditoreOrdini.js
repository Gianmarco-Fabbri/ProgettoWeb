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

        ordiniContainer.innerHTML = ""; 
        
        if (data.length === 0) {
            ordiniContainer.innerHTML = `<p class="text-center fs-4 text-muted">Nessun ordine ricevuto finora.</p>`;
            return;
        }

        data.forEach(ordine => {
            const ordineCard = document.createElement("div");
            ordineCard.classList.add("card", "mb-3", "shadow-sm", "p-3");

            ordineCard.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title text-success">Ordine #${ordine.codiceOrdine}</h5>
                    <p class="card-text"><strong>Cliente:</strong> ${ordine.emailCliente}</p>
                    <p class="card-text"><strong>Prodotto:</strong> ${ordine.nomeProdotto} (${ordine.quantita} pezzi)</p>
                    <p class="card-text"><strong>Pagamento:</strong> ${ordine.tipoPagamento}</p>
                    <p class="card-text"><strong>Stato:</strong> ${ordine.statoOrdine ? ordine.statoOrdine : "In elaborazione"}</p>
                </div>
            `;

            ordiniContainer.appendChild(ordineCard);
        });
    } catch (error) {
        console.error("Errore nel caricamento degli ordini:", error);
        document.getElementById("ordiniContainer").innerHTML = `<p class="text-danger text-center">Errore nel recupero degli ordini.</p>`;
    }
});
