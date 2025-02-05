document.addEventListener("DOMContentLoaded", function () {
    fetch('ajax/venditore/api-venditoreRecensioni.php')
        .then(response => response.json())
        .then(data => {
            const recensioniContainer = document.getElementById("recensioniContainer");

            if (!recensioniContainer) {
                console.error("Errore: Il contenitore delle recensioni non è stato trovato.");
                return;
            }

            if (data.length === 0) {
                recensioniContainer.innerHTML = `<p class="text-center fs-4 text-muted">Nessuna recensione disponibile.</p>`;
                return;
            }

            data.forEach(recensione => {
                const recensioneCard = document.createElement("div");
                recensioneCard.classList.add("card", "mb-3", "shadow-sm", "p-3");

                recensioneCard.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title text-success">${recensione.nomeProdotto}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Recensione di: ${recensione.emailCliente}</h6>
                        <div class="fs-3 text-warning">${"★".repeat(recensione.stelle)}${"☆".repeat(5 - recensione.stelle)}</div>
                        <p class="card-text mt-3">${recensione.testoRecensione}</p>
                        <p class="text-muted"><small>Data: ${recensione.data}</small></p>
                    </div>
                `;

                recensioniContainer.appendChild(recensioneCard);
            });
        })
        .catch(error => {
            console.error("Errore nel caricamento delle recensioni:", error);
            document.getElementById("recensioniContainer").innerHTML = `<p class="text-danger text-center">Errore nel recupero delle recensioni.</p>`;
        });
});
