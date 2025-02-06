document.addEventListener("DOMContentLoaded", function () {
    caricaProdotti();

    document.getElementById("aggiungiProdottoForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        const isUpdate = this.querySelector('input[name="_method"]')?.value === 'PUT';
        if (isUpdate) {
            await aggiornaProdotto();
        } else {
            await aggiungiProdotto();
        }
        caricaProdotti();
    });

    document.getElementById("modificaProdottoForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        await aggiornaProdotto();
        caricaProdotti();
    });
});

/**
 * Carica la lista dei prodotti nella tabella
 */
async function caricaProdotti() {
    try {
        const response = await fetch("ajax/api-gestione_prodotti.php");
        if (!response.ok) throw new Error(`Errore HTTP! Status: ${response.status}`);

        const prodotti = await response.json();
        const tabellaProdotti = document.getElementById("tabellaProdotti");
        tabellaProdotti.innerHTML = "";

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
                        <button class="btn btn-warning btn-sm" onclick="apriModificaProdotto('${prodotto.codiceProdotto}')">Modifica</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminaProdotto('${prodotto.codiceProdotto}')">Elimina</button>
                    </td>
                </tr>`;
        });
    } catch (error) {
        console.error("Errore nel caricamento prodotti:", error);
    }
}

/**
 * Apre il modale di modifica con i dati del prodotto selezionato
 */
async function apriModificaProdotto(codiceProdotto) {
    try {
        const response = await fetch(`ajax/api-gestione_prodotti.php?codiceProdotto=${codiceProdotto}`);
        if (!response.ok) throw new Error(`Errore HTTP! Status: ${response.status}`);
        
        const prodotto = await response.json();

        // Popola il form della modale con i dati del prodotto
        document.getElementById("modificaCodiceProdotto").value = prodotto.codiceProdotto;
        document.getElementById("modificaNome").value = prodotto.nome;
        document.getElementById("modificaDescrizione").value = prodotto.descrizione;
        document.getElementById("modificaPrezzo").value = prodotto.prezzo;
        document.getElementById("modificaCategoria").value = prodotto.categoria;

        // Verifica se Bootstrap è definito prima di usarlo
        if (typeof bootstrap !== "undefined") {
            const modal = new bootstrap.Modal(document.getElementById("modaleModificaProdotto"));
            modal.show();
        } else {
            console.error("Bootstrap non è definito. Assicurati di aver incluso bootstrap.bundle.min.js");
        }
    } catch (error) {
        console.error("Errore nel caricamento del prodotto:", error);
    }
}


/**
 * Aggiorna un prodotto esistente
 */
async function aggiornaProdotto() {
    const formData = new FormData(document.getElementById("modificaProdottoForm"));
    formData.append('_method', 'PUT');

    try {
        const response = await fetch("ajax/api-gestione_prodotti.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert("Prodotto aggiornato con successo!");
            new bootstrap.Modal(document.getElementById("modaleModificaProdotto")).hide();
            caricaProdotti();
        } else {
            alert("Errore nell'aggiornamento del prodotto.");
        }
    } catch (error) {
        console.error("Errore durante l'aggiornamento del prodotto:", error);
    }
}

/**
 * Aggiunge un nuovo prodotto
 */
async function aggiungiProdotto() {
    const formData = new FormData(document.getElementById("aggiungiProdottoForm"));

    try {
        const response = await fetch("ajax/api-gestione_prodotti.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert("Prodotto aggiunto con successo!");
            document.getElementById("aggiungiProdottoForm").reset();
            caricaProdotti();
        } else {
            alert("Errore nell'aggiunta del prodotto.");
        }
    } catch (error) {
        console.error("Errore durante l'aggiunta del prodotto:", error);
    }
}

/**
 * Elimina un prodotto
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
            caricaProdotti();
        } else {
            alert("Errore nell'eliminazione del prodotto.");
        }
    } catch (error) {
        console.error("Errore durante l'eliminazione del prodotto:", error);
    }
}
