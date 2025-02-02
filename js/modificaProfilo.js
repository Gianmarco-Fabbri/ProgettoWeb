document.addEventListener("DOMContentLoaded", function() {
    // Se hai già fetchDatiProfilo() all’avvio, qui resti come prima
    fetchDatiProfilo();

    // Aggiungi l’ascoltatore sul bottone
    document.getElementById("salvaModificheBtn").addEventListener("click", function() {
        salvaModificheProfilo();
    });
});

function salvaModificheProfilo() {
    // Prendi i valori dalla modale
    const nome = document.getElementById("editNome").value;
    const cognome = document.getElementById("editCognome").value;
    const telefono = document.getElementById("editTelefono").value;

    // Prepara i dati da inviare in POST
    const formData = new FormData();
    formData.append("nome", nome);
    formData.append("cognome", cognome);
    formData.append("telefono", telefono);

    fetch("ajax/profilo/api-modificaProfilo.php", {
        method: "POST",
        credentials: "same-origin",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Aggiornamento avvenuto con successo
            alert(data.message);

            // Chiudi la modale
            let modalEl = document.getElementById("modificaProfiloModal");
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            // Aggiorna i campi nella pagina (nome, cognome, telefono)
            document.getElementById("nome").value = nome;
            document.getElementById("cognome").value = cognome;
            document.getElementById("telefono").value = telefono;
        } else {
            // Errore dal server
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Errore:", error);
    });
}
