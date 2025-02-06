document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("applyFiltersButton"); 
    const resetButton = document.getElementById("resetFiltersButton");
    const productContainer = document.querySelector(".row.row-cols-2");
    const minPriceInput = document.getElementById("minPriceInput");
    const maxPriceInput = document.getElementById("maxPriceInput");
    const displayMinPrice = document.getElementById("displayMinPrice");
    const displayMaxPrice = document.getElementById("displayMaxPrice");

    let defaultMinPrice = 0;
    let defaultMaxPrice = 100;

    // Imposta i valori iniziali degli slider ai limiti estremi
    minPriceInput.value = defaultMinPrice;
    maxPriceInput.value = defaultMaxPrice;
    displayMinPrice.innerText = `€${defaultMinPrice}`;
    displayMaxPrice.innerText = `€${defaultMaxPrice}`;

    // Aggiorna il valore visualizzato degli slider quando vengono mossi
    minPriceInput.addEventListener("input", () => {
        displayMinPrice.innerText = `€${minPriceInput.value}`;
    });

    maxPriceInput.addEventListener("input", () => {
        displayMaxPrice.innerText = `€${maxPriceInput.value}`;
    });

    // Funzione per recuperare i prodotti filtrati per prezzo
    async function fetchProducts() {
        const minPrice = parseFloat(minPriceInput.value);
        const maxPrice = parseFloat(maxPriceInput.value);

        try {
            const response = await fetch('ajax/categorie/api-casa&green.php', { 
                method: "POST", 
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    minPrice: minPrice,
                    maxPrice: maxPrice
                })
            });

            if (!response.ok) {
                throw new Error(`Errore HTTP: ${response.status}`);
            }

            const products = await response.json();

            if (!Array.isArray(products)) {
                throw new Error("L'API non ha restituito un array di prodotti.");
            }

            updateProductList(products);

        } catch (error) {
            productContainer.innerHTML = `<p class='text-center text-danger'>Errore nel caricamento dei prodotti: ${error.message}</p>`;
        }
    }

    // Funzione per aggiornare la lista prodotti sulla pagina
    function updateProductList(products) {
        productContainer.innerHTML = "";

        if (products.length === 0) {
            productContainer.innerHTML = "<p class='text-center'>Nessun prodotto trovato.</p>";
            return;
        }

        products.forEach(product => {
            const imgSrc = product.img ? `img/${product.img}` : `img/default.png`;

            productContainer.innerHTML += `
                <div class="col text-center">
                    <a href="product.php?nome=${encodeURIComponent(product.nome)}&codiceProdotto=${encodeURIComponent(product.codiceProdotto)}&img=${encodeURIComponent(product.img)}&prezzo=${encodeURIComponent(product.prezzo)}">
                        <img src="${imgSrc}" alt="${product.nome}" class="img-fluid" style="max-height: 200px;">
                    </a>
                    <p>${product.nome} <br> 
                        <strong>€${parseFloat(product.prezzo).toFixed(2)}</strong> (IVA inclusa)
                        ${product.scontoProdotto ? `<br><span class="text-danger">Sconto: €${product.scontoProdotto}</span>` : ""}
                    </p>
                </div>
            `;
        });
    }

    // Funzione per ripristinare i filtri ai valori predefiniti
    function resetFilters() {
        minPriceInput.value = defaultMinPrice;
        maxPriceInput.value = defaultMaxPrice;

        displayMinPrice.innerText = `€${defaultMinPrice}`;
        displayMaxPrice.innerText = `€${defaultMaxPrice}`;

        fetchProducts();
    }

    // Event Listener per il pulsante "Filtra"
    filterButton.addEventListener("click", async () => {
        await fetchProducts();
    });

    // Event Listener per il pulsante "Ripristina filtri"
    resetButton.addEventListener("click", async () => {
        await resetFilters();
    });

    // Caricamento iniziale dei prodotti
    fetchProducts();
});
