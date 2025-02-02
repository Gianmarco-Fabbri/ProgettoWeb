// Funzione per estrarre i parametri dalla query string
function getProdottoDataFromURL() {
    const params = new URLSearchParams(window.location.search);
    return {
        nome: params.get('nome'),
        codiceProdotto: params.get('codiceProdotto'),
        img: params.get('img'),
        prezzo: params.get('prezzo')
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const prodottoData = getProdottoDataFromURL();

    if (prodottoData.nome) {
        document.getElementById('productNome').textContent = prodottoData.nome;
    }
    if (prodottoData.img) {
        // Percorso relativo dell'immagine (img/)
        document.getElementById('productImg').src = `img/${prodottoData.img}`;
        document.getElementById('productImg').alt = prodottoData.nome;
    }
    if (prodottoData.prezzo) {
        document.getElementById('productPrezzo').textContent = prodottoData.prezzo;
    }
    if (prodottoData.codiceProdotto) {
        document.getElementById('productCodice').textContent = prodottoData.codiceProdotto;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const nome = params.get('nome') || 'Nome del prodotto';
    const prezzo = params.get('prezzo') || 'Prezzo';
    const codice = params.get('codiceProdotto') || '';
    const img = params.get('img');

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
