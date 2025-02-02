document.addEventListener("DOMContentLoaded", function () {
    fetchDatiProfilo();
});

async function fetchDatiProfilo() {
    try {
        const response = await fetch("ajax/profilo/api-profilo.php", {
            method: "GET",
            credentials: "same-origin"
        });

        if (!response.ok) {
            console.error("Errore nel recupero dati utente:", response.status);
            return;
        }

        const data = await response.json();
        document.getElementById("nome").value = data.nome;
        document.getElementById("cognome").value = data.cognome;
        document.getElementById("email").value = data.email;
        document.getElementById("telefono").value = data.telefono;

    } catch (error) {
        console.error("Errore di connessione o fetch:", error);
    }
}
