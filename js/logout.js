document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("logoutBtn");

    if (logoutButton) {
        logoutButton.addEventListener("click", async function () {
            try {
                const response = await fetch("ajax/login/api-logout.php", {
                    method: "POST",
                    credentials: "same-origin"
                });

                if (response.ok) {
                    window.location.href = "accedi.php";
                } else {
                    alert("Errore durante il logout. Riprova.");
                }
            } catch (error) {
                console.error("Errore nel logout:", error);
                alert("Si è verificato un errore di connessione. Riprova più tardi.");
            }
        });
    }
});
