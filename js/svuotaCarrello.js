function svuotaCarrello() {
    const contenitoreProdotti = document.querySelector(".row.g-3");

    if (contenitoreProdotti) {
        contenitoreProdotti.innerHTML = "";
    }
    aggiornaTotale();
}

function aggiornaTotale() {
    const subtotale = document.querySelector("dd.text-end");
    const scontoPunti = document.querySelector(".text-success.text-end");
    const totale = document.querySelector("h4.text-primary");

    if (subtotale) subtotale.textContent = "$0.00";
    if (scontoPunti) scontoPunti.textContent = "-$0.00";
    if (totale) totale.textContent = "Totale: $0.00";
}

document.addEventListener("DOMContentLoaded", function () {
    const bottoniSvuota = document.querySelectorAll("[data-svuota-carrello]");
    
    bottoniSvuota.forEach(bottone => {
        bottone.addEventListener("click", svuotaCarrello);
    });
});
