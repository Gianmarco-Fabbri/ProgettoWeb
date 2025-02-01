function toggleVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.src = input.type === 'password' 
        ? 'img/eye_close.png' 
        : 'img/eye_open.png';
}

document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registration-form");

    if (!registerForm) {
        console.error("Errore: il form di registrazione non è stato trovato.");
        return;
    }

    registerForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const firstName = document.getElementById('first_name').value.trim();
        const lastName = document.getElementById('last_name').value.trim();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();
        const submitButton = registerForm.querySelector("button[type='submit']");

        if (!firstName || !lastName || !username || !email || !phone || !password || !confirmPassword) {
            showMessage("Tutti i campi sono obbligatori.", "error");
            return;
        }

        if (password !== confirmPassword) {
            showMessage("Le password non corrispondono.", "error");
            return;
        }

        let formData = new FormData();
        formData.append("first_name", firstName);
        formData.append("last_name", lastName);
        formData.append("username", username);
        formData.append("email", email);
        formData.append("phone", phone);
        formData.append("password", password);

        // Disabilita il pulsante di registrazione durante la richiesta
        submitButton.disabled = true;
        submitButton.innerText = "Registrazione in corso...";

        try {
            const response = await fetch("ajax/login/api-registrazione.php", {
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                throw new Error(`Errore HTTP: ${response.status}`);
            }

            const result = await response.json();

            if (result.success) {
                showMessage("Registrazione completata! Reindirizzamento...", "success");
                setTimeout(() => {
                    window.location.href = "accedi.php";
                }, 1000);
            } else {
                showMessage(result.message, "error");
            }
        } catch (error) {
            console.error("Errore nella richiesta AJAX:", error);
            showMessage("Errore di connessione. Riprova più tardi.", "error");
        } finally {
            // Riabilita il pulsante dopo la risposta
            submitButton.disabled = false;
            submitButton.innerText = "Registrati";
        }
    });

    /**
     * Funzione per mostrare un messaggio di errore o successo
     */
    function showMessage(message, type) {
        let messageBox = document.getElementById("message-box");
        if (!messageBox) {
            console.error("Errore: il contenitore del messaggio non è stato trovato.");
            return;
        }
        messageBox.innerText = message;
        messageBox.className = type === "success" ? "alert alert-success" : "alert alert-danger";
        messageBox.style.display = "block";
    }    
});
