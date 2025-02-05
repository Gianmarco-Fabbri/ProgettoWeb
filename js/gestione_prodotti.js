document.addEventListener("DOMContentLoaded", function() {
    caricaProdotti();

    document.getElementById("aggiungiProdottoForm").addEventListener("submit", async function(e) {
        e.preventDefault();
        await aggiungiProdotto();
        caricaProdotti(); // Ricarica la lista dopo l'aggiunta
    });
});

/**
 * Carica la lista dei prodotti dal server e aggiorna la tabella.
 */
async function caricaProdotti() {
    try {
        const response = await fetch("ajax/api-gestione_prodotti.php");
        if (!response.ok) {
            throw new Error(`Errore HTTP! Status: ${response.status}`);
        }

        const prodotti = await response.json();
        console.log("Prodotti ricevuti:", prodotti);

        const tabellaProdotti = document.getElementById("tabellaProdotti");
        tabellaProdotti.innerHTML = ""; // Pulisce la tabella prima di caricare nuovi dati

        prodotti.forEach(prodotto => {
            tabellaProdotti.innerHTML += `
                <tr>
                    <td>${prodotto.codiceProdotto}</td>
                    <td><img src="img/${prodotto.img}" alt="${prodotto.nome}" width="50"></td>
                    <td>${prodotto.nome}</td>
                    <td>${prodotto.descrizione}</td>
                    <td>€${prodotto.prezzo}</td>
                    <td>${prodotto.categoria}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="eliminaProdotto('${prodotto.codiceProdotto}')">Elimina</button>
                    </td>
                </tr>`;
        });
    } catch (error) {
        console.error("Errore nel caricamento prodotti:", error);
    }
}

/**
 * Aggiunge un nuovo prodotto tramite la API.
 */
async function aggiungiProdotto() {
    const formData = new FormData(document.getElementById("aggiungiProdottoForm"));

    try {
        const response = await fetch("ajax/api-gestione_prodotti.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        console.log("Risposta API:", result);
        if (result.success) {
            alert("Prodotto aggiunto con successo!");
            document.getElementById("aggiungiProdottoForm").reset();
        } else {
            alert("Errore nell'aggiunta del prodotto.");
        }
    } catch (error) {
        console.error("Errore durante l'aggiunta del prodotto:", error);
    }
}

/**
 * Elimina un prodotto dal database.
 */
async function eliminaProdotto(codiceProdotto) {
    if (!confirm("Sei sicuro di voler eliminare questo prodotto?")) {
        return;
    }

    try {
        const response = await fetch("ajax/api-gestione_prodotti.php", {
            method: "DELETE",
            body: new URLSearchParams({ codiceProdotto })
        });

        const result = await response.json();
        if (result.success) {
            alert("Prodotto eliminato con successo!");
            caricaProdotti(); // Ricarica la lista prodotti
        } else {
            alert("Errore nell'eliminazione del prodotto.");
        }
    } catch (error) {
        console.error("Errore durante l'eliminazione del prodotto:", error);
    }
}
