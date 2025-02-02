document.addEventListener("DOMContentLoaded", function () {
    fetchDatiProfilo();
});

async function fetchDatiProfilo() {
    try {
        const response = await fetch("ajax/api-profilo.php", {
            method: "GET",
            credentials: "same-origin"
        });

        if (!response.ok) {
            if (response.status === 401) {
                window.location.href = "accedi.php";
                return;
            }
            console.error("Errore nel recupero dati utente:", response.status);
            return;
        }

        const data = await response.json();

        // Popola i campi (che in profilo_main.php hanno classi .nomeUtente, .cognomeUtente, ecc.)
        document.querySelector(".nomeUtente").value = data.nome;
        document.querySelector(".cognomeUtente").value = data.cognome;
        document.querySelector(".emailUtente").value = data.email;
        document.querySelector(".telefonoUtente").value = data.telefono;
        
    } catch (error) {
        console.error("Errore di connessione o fetch:", error);
    }
}
