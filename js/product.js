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

    if (kitData.nome) {
        document.getElementById('productNome').textContent = kitData.nome;
    }
    if (kitData.img) {
        // Percorso relativo dell'immagine (img/)
        document.getElementById('productImg').src = `img/${kitData.img}`;
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
    const params = new URLSearchParams(window.location.search);
    const nome = params.get('nome') || 'Nome del prodotto';
    const prezzo = params.get('prezzo') || 'Prezzo';
    const codice = params.get('codiceKit') || '';
    const img = params.get('img') || 'default.png';

    document.getElementById('productNome').textContent = nome;
    document.getElementById('productPrezzo').textContent = "€"+prezzo;
    document.getElementById('productCodice').textContent = "Codice prodotto: " + codice;
    document.getElementById('productImg').src = "img/" + img;
    document.getElementById('idProdotto').value = codice;

    // Click -> Aggiungi al carrello
    document.getElementById('addToCartButton').addEventListener('click', () => {
        const idProdotto = document.getElementById('idProdotto').value;
        const quantita = document.getElementById('quantita').value;

        if (!idProdotto) {
            alert("Errore: il codice del prodotto è mancante.");
            return;
        }

        if (quantita < 1) {
            alert("La quantità deve essere almeno 1.");
            return;
        }

        const formData = new URLSearchParams();
        formData.append('idProdotto', idProdotto);
        formData.append('quantita', quantita);

        fetch('ajax/carrello/aggiungiProdotto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData.toString()
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Prodotto aggiunto al carrello!");
            } else {
                alert("Errore: " + data.message);
            }
        })
        .catch(error => console.error('Errore:', error));
    });
});
