document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#eliminaAccountModal button.btn-danger").addEventListener("click", function () {
        // Seleziona il contenitore dei messaggi
        const messageContainer = document.querySelector("#eliminaAccountModal .message");
        messageContainer.style.color = "#B00000";
        messageContainer.textContent = ""; 

        fetch("ajax/profilo/api-eliminaAccount.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({})
        })
        .then(response => response.text()) 
        .then(text => {        
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    messageContainer.style.color = "#006400";
                    messageContainer.textContent = "Account eliminato con successo. Reindirizzamento in corso...";
                    setTimeout(() => window.location.href = "accedi.php", 1000);
                } else {
                    messageContainer.textContent = data.message || "Errore durante l'eliminazione dell'account.";
                }
            } catch (error) {
                messageContainer.textContent = "Errore interno. Contatta il supporto.";
            }
        })
        .catch(error => {
            messageContainer.textContent = "Si è verificato un errore. Riprova più tardi.";
        });
    });
});
