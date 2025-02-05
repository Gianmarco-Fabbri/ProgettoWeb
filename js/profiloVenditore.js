document.addEventListener("DOMContentLoaded", async function () {
    console.log("Script profilo_venditore.js avviato!");

    try {
        const response = await fetch("ajax/venditore/api-profilo_venditore.php");

        if (!response.ok) {
            throw new Error(`HTTP Error! Status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log("Dati venditore ricevuti:", data);

        if (data.success) {
            document.getElementById("email").textContent = data.venditore.email;
            document.getElementById("telefono").textContent = data.venditore.telefono;
        } else {
            console.error("Errore nel caricamento del profilo:", data.message);
        }
    } catch (error) {
        console.error("Errore di connessione:", error);
    }
});
