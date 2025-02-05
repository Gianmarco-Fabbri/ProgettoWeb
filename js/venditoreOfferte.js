document.addEventListener("DOMContentLoaded", function() {
    loadProducts();
    loadOffers();

    // Aggiunta di un prodotto in offerta
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();
        addOffer();
    });

    // Rimozione di un prodotto in offerta (event delegation per elementi dinamici)
    document.querySelector("tbody").addEventListener("click", function(event) {
        if (event.target.classList.contains("remove-offer")) {
            const productId = event.target.dataset.id;
            removeOffer(productId);
        }
    });
});

function loadProducts() {
    fetch("ajax/venditore/api-getProdottiSenzaOfferta.php")
        .then(response => response.json())
        .then(products => {
            const select = document.querySelector("#productSelect"); // Aggiunto id per selezione diretta
            select.innerHTML = '<option selected>Seleziona un prodotto</option>';
            products.forEach(product => {
                // CodiceProdotto come valore, Nome visibile all'utente
                select.innerHTML += `<option value="${product.codiceProdotto}">${product.nome}</option>`;
            });
        })
        .catch(error => console.error("Errore nel caricamento dei prodotti:", error));
}

function addOffer() {
    const productId = document.querySelector("#productSelect").value;
    const discount = document.querySelector("#discountPercentage").value;

    if (productId === "Seleziona un prodotto" || discount <= 0 || discount > 100) {
        alert("Seleziona un prodotto valido e inserisci uno sconto corretto.");
        return;
    }

    fetch("ajax/venditore/api-aggiungiOfferta.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ productId, discount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadOffers();
            loadProducts();
        } else {
            alert("Errore nell'aggiunta dell'offerta.");
        }
    })
    .catch(error => console.error("Errore:", error));
}

/* Prodotti in offerta */
function loadOffers() {
    fetch("ajax/venditore/api-getProdottiInOfferta.php")
        .then(response => response.json())
        .then(offers => {
            const tbody = document.querySelector("tbody");
            tbody.innerHTML = "";
            offers.forEach(offer => {
                tbody.innerHTML += `
                    <tr>
                        <td><img src="img/${offer.img}" alt="Prodotto" class="img-fluid" style="max-width: 40px;"></td>
                        <td>${offer.nome}</td>
                        <td class="d-none d-md-table-cell">€${offer.prezzo}</td>
                        <td>€${offer.scontoProdotto}</td>
                        <td class="d-none d-md-table-cell">€${offer.prezzo-offer.scontoProdotto}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-offer" data-id="${offer.codiceProdotto}">Rimuovi Offerta</button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => console.error("Errore nel caricamento delle offerte:", error));
}

/* Rimozione di un'offerta */
function removeOffer(productId) {
    fetch("ajax/venditore/api-rimuoviOfferta.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadOffers();
            loadProducts();
        } else {
            alert("Errore nella rimozione dell'offerta.");
        }
    })
    .catch(error => console.error("Errore:", error));
}
