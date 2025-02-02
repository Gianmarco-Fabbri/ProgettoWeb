document.addEventListener("DOMContentLoaded", async function () {
    const notificheLista = document.getElementById("notifiche-lista");

    async function caricaNotifiche() {
        try {
            const response = await fetch("ajax/api-notifiche.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "azione=getNotifiche"
            });

            const data = await response.json();
            if (data.status !== "success") throw new Error(data.message);

            const notifiche = data.notifiche;
            notificheLista.innerHTML = ""; 

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
                    <button class="btn btn-danger btn-sm elimina-notifica" data-id="${notifica.id}">X</button>
                `;

                notificheLista.appendChild(notificaElemento);
            });

            // Aggiungi event listener ai bottoni "Segna come letta"
            document.querySelectorAll(".segna-letta").forEach(button => {
                button.addEventListener("click", async function () {
                    const idNotifica = this.getAttribute("data-id");
                    await segnaNotificaComeLetta(idNotifica);
                    this.parentElement.remove();
                    if (document.querySelectorAll(".list-group-item").length === 0) {
                        notificheLista.innerHTML = "<p class='text-center'>Nessuna notifica disponibile.</p>";
                    }
                });
            });

            // Aggiungi event listener ai bottoni "Elimina notifica"
            document.querySelectorAll(".elimina-notifica").forEach(button => {
                button.addEventListener("click", async function () {
                    const idNotifica = this.getAttribute("data-id");
                    await eliminaNotifica(idNotifica);
                    this.parentElement.remove();
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
            const response = await fetch("ajax/api-notifiche.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `azione=setNotificaLetta&id_notifica=${encodeURIComponent(idNotifica)}`
            });

            const result = await response.json();
            if (result.status !== "success") throw new Error(result.message);
        } catch (error) {
            console.error("Errore nel segnare la notifica come letta:", error);
        }
    }

    async function eliminaNotifica(idNotifica) {
        try { 
                const response = await fetch("ajax/api-notifiche.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `azione=deleteNotifica&id_notifica=${encodeURIComponent(idNotifica)}`
            });

            const result = await response.json();
            if (result.status !== "success") throw new Error(result.message);
        } catch (error) {
            console.error("Errore nell'eliminare la notifica:", error);
        }
    }

    await caricaNotifiche();
});
