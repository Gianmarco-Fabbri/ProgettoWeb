// Funzione per estrarre i parametri dalla query string
function getKitDataFromURL() {
    const params = new URLSearchParams(window.location.search);
    return {
        nome: params.get('nome'),
        codiceKit: params.get('codiceKit'),
        img: params.get('img'),
        prezzo: params.get('prezzo')
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const kitData = getKitDataFromURL();

    // Assicurati di avere nel DOM degli elementi con gli id o classi corrispondenti per poter aggiornare il contenuto.
    // Ad esempio, supponiamo di avere:
    // - un elemento con id="productNome" per il nome
    // - un elemento con id="productImg" per l'immagine
    // - un elemento con id="productPrezzo" per il prezzo
    // - un elemento con id="productCodice" per il codice del kit

    if (kitData.nome) {
        document.getElementById('productNome').textContent = kitData.nome;
    }
    if (kitData.img) {
        // Imposta il percorso dell'immagine (ad esempio, se le immagini sono in ../img/)
        document.getElementById('productImg').src = `img/${kitData.img}`;
        // Aggiorna anche l'attributo alt
        document.getElementById('productImg').alt = kitData.nome;
    }
    if (kitData.prezzo) {
        document.getElementById('productPrezzo').textContent = kitData.prezzo;
    }
    if (kitData.codiceKit) {
        document.getElementById('productCodice').textContent = kitData.codiceKit;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const addToCartButton = document.getElementById('addToCartButton');
    if (addToCartButton) {
        addToCartButton.addEventListener('click', () => {
            // Recupera l'id del prodotto dal campo nascosto
            const idProdotto = document.getElementById('idProdotto').value;
            // Recupera la quantità dall'input
            const quantita = document.getElementById('quantita').value;

            // Verifica che la quantità sia almeno 1
            if (quantita < 1) {
                alert("La quantità deve essere almeno 1.");
                return;
            }

            // Prepara i dati per la richiesta (x-www-form-urlencoded)
            const formData = new URLSearchParams();
            formData.append('idProdotto', idProdotto);
            formData.append('quantita', quantita);

            // Effettua la richiesta al file PHP che gestisce l'aggiunta al carrello
            fetch('ajax/carrello/aggiungiProdotto.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Puoi mostrare un messaggio o aggiornare un contatore nel DOM
                    alert("Prodotto aggiunto al carrello!");
                } else {
                    alert("Errore nell'aggiunta del prodotto: " + data.message);
                }
            })
            .catch(error => console.error('Errore:', error));
        });
    }
});


