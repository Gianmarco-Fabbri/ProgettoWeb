// Funzione per svuotare il carrello
function svuotaCarrello() {
    // Seleziona il contenitore dei prodotti nel carrello
    const contenitoreProdotti = document.querySelector(".row.g-3");

    // Rimuove tutti i prodotti
    if (contenitoreProdotti) {
        contenitoreProdotti.innerHTML = "";
    }

    // Aggiorna il riepilogo ordine
    aggiornaTotale();
}

// Funzione per aggiornare il riepilogo ordine
function aggiornaTotale() {
    const subtotale = document.querySelector("dd.text-end");
    const scontoPunti = document.querySelector(".text-success.text-end");
    const totale = document.querySelector("h4.text-primary");

    if (subtotale) subtotale.textContent = "$0.00";
    if (scontoPunti) scontoPunti.textContent = "-$0.00";
    if (totale) totale.textContent = "Totale: $0.00";
}

// Assegna la funzione a tutti i bottoni con l'attributo `data-svuota-carrello`
document.addEventListener("DOMContentLoaded", function () {
    const bottoniSvuota = document.querySelectorAll("[data-svuota-carrello]");
    
    bottoniSvuota.forEach(bottone => {
        bottone.addEventListener("click", svuotaCarrello);
    });
});
