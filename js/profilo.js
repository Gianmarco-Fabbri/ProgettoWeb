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

        // Controlla se gli elementi esistono prima di assegnare i valori
        if (document.getElementById("editNome")) document.getElementById("editNome").value = data.nome || "";
        if (document.getElementById("editCognome")) document.getElementById("editCognome").value = data.cognome || "";
        if (document.getElementById("email")) document.getElementById("email").value = data.email || "";
        if (document.getElementById("editTelefono")) document.getElementById("editTelefono").value = data.telefono || "";


        // document.getElementById("nome").value = data.nome;
        // document.getElementById("cognome").value = data.cognome;
        // document.getElementById("email").value = data.email;
        // document.getElementById("telefono").value = data.telefono;

    } catch (error) {
        console.error("Errore di connessione o fetch:", error);
    }
}
