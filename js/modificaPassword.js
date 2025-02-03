function toggleVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.src = input.type === 'password' ? 'img/eye_close.png' : 'img/eye_open.png';
}

document.getElementById("cambiaPasswordForm").addEventListener("submit", function (event) {
    event.preventDefault(); 

    // Ottiene i valori dei campi del form
    const passwordAttuale = document.getElementById("passwordAttuale").value;
    const nuovaPassword = document.getElementById("nuovaPassword").value;
    const confermaNuovaPassword = document.getElementById("confermaNuovaPassword").value;

    // Reset del messaggio di errore
    document.querySelector(".message-container").innerHTML = '';

    // Verifica che i campi non siano vuoti
    if (!passwordAttuale || !nuovaPassword || !confermaNuovaPassword) {
        document.querySelector(".message-container").innerHTML = `<p style="color: #B00000;">Tutti i campi sono richiesti.</p>`;
        return; // Ferma l'esecuzione se i campi sono vuoti
    }

    // Verifica che le nuove password coincidano
    if (nuovaPassword !== confermaNuovaPassword) {
        document.querySelector(".message-container").innerHTML = `<p style="color: #B00000;">Le nuove password non corrispondono.</p>`;
        return;
    }

    // Logica per inviare i dati al server
    fetch('ajax/profilo/api-modificaPassword.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            passwordAttuale: passwordAttuale,
            nuovaPassword: nuovaPassword
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(".message-container").innerHTML = `<p style="color: #006400;">Password cambiata con successo! Reindirizzamento in corso...</p>`;
            setTimeout(function () {
                document.getElementById("modificaPasswordModal").style.display = "none";
                window.location.href = "profilo.php";
            }, 1000); 
        } else {
            document.querySelector(".message-container").innerHTML = `<p style="color: #B00000;">${data.message || "Errore durante la modifica della password."}</p>`;
        }
    })
});