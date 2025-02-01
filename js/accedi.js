document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Evita il refresh della pagina

        let formData = new FormData(this);

        fetch("ajax/api-accedi.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "index.php"; // Reindirizzamento dopo login riuscito
            } else {
                let errorMessage = document.getElementById("error-message");
                errorMessage.innerText = data.message;
                errorMessage.style.display = "block";
            }
        })
        .catch(error => console.error("Errore nella richiesta AJAX:", error));
    });
});
