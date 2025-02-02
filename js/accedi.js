function toggleVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.src = input.type === 'password' ? 'img/eye_close.png' : 'img/eye_open.png';
}

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");

    if (!loginForm) {
        console.error("Errore: il form di login non è stato trovato.");
        return;
    }

    loginForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!email || !password) {
            showMessage("Email e password sono obbligatori.", "error");
            return;
        }

        const data = { email, password };

        try {
            const response = await fetch('ajax/login/api-accedi.php', { 
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showMessage("Accesso effettuato con successo! Reindirizzamento...", "success");
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1000);
            } else {
                showMessage(result.message, "error");
            }
        } catch (error) {
            console.error("Errore nella richiesta AJAX:", error);
            showMessage("Errore di connessione. Riprova più tardi.", "error");
        }
    });

    function showMessage(message, type) {
        let messageBox = document.getElementById("error-message");
        if (!messageBox) {
            console.error("Errore: il contenitore del messaggio non è stato trovato.");
            return;
        }
        messageBox.innerText = message;
        messageBox.className = type === "success" ? "alert alert-success" : "alert alert-danger";
        messageBox.style.display = "block";
    }
});
