document.addEventListener("DOMContentLoaded", async function () {
    const notificheLista = document.getElementById("notifiche-lista");

    // Recupera l'email dell'utente loggato da sessionStorage/localStorage (se gestito lato frontend)
    let emailUtente = localStorage.getItem("emailUtente") || sessionStorage.getItem("emailUtente");

    // Se l'email non è disponibile, prova a ottenerla da un'API di sessione
    if (!emailUtente) {
        try {
            const response = await fetch("../api/sessione.php");
            if (response.ok) {
                const data = await response.json();
                emailUtente = data.email || "";
            }
        } catch (error) {
            console.error("Errore nel recupero della sessione utente:", error);
        }
    }

    if (!emailUtente) {
        notificheLista.innerHTML = "<p class='text-center text-danger'>Errore: utente non autenticato.</p>";
        return;
    }

    async function caricaNotifiche() {
        try {
            const response = await fetch(`../api/notifiche.php?azione=getNotifiche&email=${encodeURIComponent(emailUtente)}`);
            if (!response.ok) throw new Error("Errore nel recupero delle notifiche");

            const notifiche = await response.json();
            notificheLista.innerHTML = ""; // Svuota la lista prima di popolarla

            if (notifiche.length === 0) {
                notificheLista.innerHTML = "<p class='text-center'>Nessuna notifica disponibile.</p>";
                return;
            }

            notifiche.forEach(notifica => {
                const notificaElemento = document.createElement("div");
                notificaElemento.className = "list-group-item d-flex justify-content-between align-items-start";
                notificaElemento.innerHTML = `
                    <div>
                        <p class="mb-1"><strong>${notifica.tipo}</strong></p>
                        <p class="text-muted">${notifica.messaggio}</p>
                        <p class="text-muted"><small>${new Date(notifica.data_notifica).toLocaleString()}</small></p>
                    </div>
                    <button class="btn btn-success btn-sm segna-letta" data-id="${notifica.id}">Segna come letta</button>
                `;

                notificheLista.appendChild(notificaElemento);
            });

            // Aggiungi event listener ai bottoni "Segna come letta"
            document.querySelectorAll(".segna-letta").forEach(button => {
                button.addEventListener("click", async function () {
                    const idNotifica = this.getAttribute("data-id");
                    const notificaElemento = this.parentElement;

                    await segnaNotificaComeLetta(idNotifica);
                    
                    // Rimuovi la notifica dalla lista senza ricaricare tutta la pagina
                    notificaElemento.remove();

                    // Se non ci sono più notifiche, mostra il messaggio di lista vuota
                    if (document.querySelectorAll(".list-group-item").length === 0) {
                        notificheLista.innerHTML = "<p class='text-center'>Nessuna notifica disponibile.</p>";
                    }
                });
            });

        } catch (error) {
            console.error("Errore nel caricamento delle notifiche:", error);
        }
    }

    async function segnaNotificaComeLetta(idNotifica) {
        try {
            const response = await fetch("../api/notifiche.php?azione=setNotificaLetta", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${encodeURIComponent(idNotifica)}`
            });

            const result = await response.json();
            if (!result.success) throw new Error("Errore nella marcatura della notifica");
        } catch (error) {
            console.error("Errore nel segnare la notifica come letta:", error);
        }
    }

    await caricaNotifiche();
});
